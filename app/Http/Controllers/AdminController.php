<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Participant;
use App\Models\Question;

class AdminController extends Controller
{
    private function getSettings()
    {
        $path = storage_path('app/settings.json');
        if (!file_exists($path)) {
            return ['show_kunci_jawaban' => true, 'menit_per_soal' => 1, 'jumlah_soal_per_mapel' => 50];
        }
        $settings = json_decode(file_get_contents($path), true) ?? ['show_kunci_jawaban' => true];
        if (!isset($settings['menit_per_soal'])) {
            $settings['menit_per_soal'] = 1;
        }
        if (!isset($settings['jumlah_soal_per_mapel'])) {
            $settings['jumlah_soal_per_mapel'] = 50;
        }
        return $settings;
    }

    public function index()
    {
        $participants = Participant::orderBy('created_at', 'desc')->get();
        $questions = Question::orderBy('created_at', 'desc')->get();
        $settings = $this->getSettings();
        return view('admin.dashboard', compact('participants', 'questions', 'settings'));
    }

    public function toggleKunciJawaban()
    {
        $settings = $this->getSettings();
        $settings['show_kunci_jawaban'] = !($settings['show_kunci_jawaban'] ?? true);
        file_put_contents(storage_path('app/settings.json'), json_encode($settings));
        return redirect()->back()->with('success', 'Konfigurasi kunci jawaban berhasil diubah');
    }

    public function updateWaktuSoal(Request $request)
    {
        $settings = $this->getSettings();
        $settings['menit_per_soal'] = max(1, (int) $request->input('menit_per_soal', 1));
        file_put_contents(storage_path('app/settings.json'), json_encode($settings));
        return redirect()->back()->with('success', 'Waktu per soal berhasil diubah');
    }

    public function updateJumlahSoal(Request $request)
    {
        $settings = $this->getSettings();
        $settings['jumlah_soal_per_mapel'] = max(1, (int) $request->input('jumlah_soal_per_mapel', 50));
        file_put_contents(storage_path('app/settings.json'), json_encode($settings));
        return redirect()->back()->with('success', 'Jumlah soal per mata pelajaran berhasil diubah');
    }

    public function getGeminiPrompt(Request $request)
    {
        $mapel = $request->input('mapel');
        $jumlah = $request->input('jumlah', 10);
        $tingkat = $request->input('tingkat', 'Sulit');
        $kategori = $mapel === 'TPA' ? 'TPA' : 'Akademik';

        $existingQuestions = Question::where('mapel', $mapel)->pluck('soal')->toArray();
        $existingJson = json_encode($existingQuestions, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        $prompt = "Bertindaklah sebagai pembuat soal ujian yang profesional. Buatkan $jumlah soal pilihan ganda tingkat kesulitan '$tingkat' untuk mata pelajaran $mapel. \n\n"
                . "PENTING:\n"
                . "1. Soal-soal ini tidak boleh sama, mirip, atau memiliki makna yang serupa dengan daftar soal berikut yang sudah ada di database saya:\n"
                . $existingJson . "\n\n"
                . "2. WAJIB gunakan format LaTeX/MathJax untuk SEMUA unsur matematika (rumus, angka, variabel seperti x, y, persamaan, dsb). WAJIB gunakan pembatas \\( ... \\) untuk rumus di dalam baris (inline), atau $$ ... $$ untuk rumus di baris terpisah (blok). Contoh salah: x^2 = 4. Contoh benar: \\( x^2 = 4 \\).\n\n"
                . "3. PENTING: Struktur JSON (key dan value) WAJIB menggunakan tanda kutip ganda (\"). NAMUN, JANGAN PERNAH menggunakan tanda kutip ganda (\") di DALAM isi teks soal maupun pilihan ganda. Jika Anda butuh tanda kutip di dalam kalimat, gunakan HANYA tanda kutip tunggal ('). Penggunaan tanda kutip ganda di dalam teks akan merusak format JSON!\n\n"
                . "4. PENTING: JANGAN menggunakan baris baru (enter/newline) asli secara langsung di dalam string JSON. Gunakan \\n untuk membuat baris baru di teks soal atau pembahasan.\n\n"
                . "Keluarkan hasil akhir HANYA dalam format JSON Array mentah, tanpa markdown, tanpa penjelasan lain. Struktur JSON wajib persis seperti ini untuk setiap soal:\n"
                . "[\n  {\n    \"kategori\": \"$kategori\",\n    \"mapel\": \"$mapel\",\n    \"tingkat_kesulitan\": \"$tingkat\",\n    \"soal\": \"teks soal dengan \\( rumus \\) dan tanda kutip tunggal 'seperti ini'\",\n    \"pilihan_a\": \"pilihan A\",\n    \"pilihan_b\": \"pilihan B\",\n    \"pilihan_c\": \"pilihan C\",\n    \"pilihan_d\": \"pilihan D\",\n    \"jawaban\": \"A\",\n    \"pembahasan\": \"Langkah-langkah penyelesaian atau penjelasan ringkas mengenai mengapa jawaban tersebut benar.\",\n    \"bobot\": 4\n  }\n]";

        return response()->json(['prompt' => $prompt]);
    }

    public function importGeminiJson(Request $request)
    {
        $jsonString = $request->input('json_data');
        
        // Bersihkan string dari markdown json
        $jsonString = preg_replace('/```json\s*/', '', $jsonString);
        $jsonString = preg_replace('/```\s*/', '', $jsonString);
        // Ekstrak hanya bagian JSON array-nya saja untuk mengabaikan teks basa-basi Gemini
        $start = strpos($jsonString, '[');
        $end = strrpos($jsonString, ']');
        if ($start !== false && $end !== false && $end > $start) {
            $jsonString = substr($jsonString, $start, $end - $start + 1);
        } else {
            return redirect()->back()->with('error', "Tidak dapat menemukan format Array JSON yang valid di dalam teks.");
        }

        // HAPUS karakter control asli (enter/newline/tab mentah) yang merusak format JSON
        $jsonString = preg_replace('/[\r\n\t]+/', ' ', $jsonString);

        // Perbaiki backslash dari LaTeX (\frac, \sin, \to) agar JSON valid
        $jsonString = preg_replace_callback('/\\\\\\\\|\\\\([^"\\\\\/nu])/', function($matches) {
            if (isset($matches[1])) {
                return '\\\\' . $matches[1];
            }
            return $matches[0];
        }, $jsonString);

        $data = json_decode(trim($jsonString), true);

        if (json_last_error() !== JSON_ERROR_NONE || !$data || !is_array($data)) {
            $errorMsg = json_last_error_msg();
            return redirect()->back()->with('error', "Format JSON tidak valid ($errorMsg). Pastikan Anda hanya menyalin JSON Array murni dari Gemini.");
        }

        $imported = 0;
        foreach ($data as $q) {
            if (isset($q['soal']) && isset($q['jawaban'])) {
                Question::create([
                    'kategori' => $q['kategori'] ?? 'Akademik',
                    'mapel' => $q['mapel'] ?? 'Umum',
                    'tingkat_kesulitan' => $q['tingkat_kesulitan'] ?? 'Sulit',
                    'soal' => $q['soal'],
                    'pilihan_a' => $q['pilihan_a'] ?? '-',
                    'pilihan_b' => $q['pilihan_b'] ?? '-',
                    'pilihan_c' => $q['pilihan_c'] ?? '-',
                    'pilihan_d' => $q['pilihan_d'] ?? '-',
                    'jawaban' => $q['jawaban'],
                    'pembahasan' => $q['pembahasan'] ?? null,
                    'bobot' => $q['bobot'] ?? 4
                ]);
                $imported++;
            }
        }

        return redirect()->back()->with('success', "Berhasil mengimpor $imported soal baru dari Gemini!");
    }

    public function updateQuestion(Request $request, $id)
    {
        $q = Question::findOrFail($id);
        $q->update($request->all());
        return redirect()->back()->with('success', 'Soal berhasil diperbarui!');
    }

    public function deleteQuestion($id)
    {
        Question::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Soal berhasil dihapus!');
    }

    public function bulkDeleteQuestions(Request $request)
    {
        $ids = json_decode($request->input('ids', '[]'), true);
        if (is_array($ids) && count($ids) > 0) {
            Question::whereIn('id', $ids)->delete();
            return redirect()->back()->with('success', count($ids) . ' soal berhasil dihapus!');
        }
        return redirect()->back()->with('error', 'Tidak ada soal yang dipilih untuk dihapus.');
    }
}
