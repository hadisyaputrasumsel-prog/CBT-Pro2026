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
            return ['show_kunci_jawaban' => true];
        }
        return json_decode(file_get_contents($path), true) ?? ['show_kunci_jawaban' => true];
    }

    public function index()
    {
        $participants = Participant::orderBy('created_at', 'desc')->get();
        $settings = $this->getSettings();
        return view('admin.dashboard', compact('participants', 'settings'));
    }

    public function toggleKunciJawaban()
    {
        $settings = $this->getSettings();
        $settings['show_kunci_jawaban'] = !($settings['show_kunci_jawaban'] ?? true);
        file_put_contents(storage_path('app/settings.json'), json_encode($settings));
        return redirect()->back()->with('success', 'Konfigurasi berhasil diubah');
    }

    public function getGeminiPrompt(Request $request)
    {
        $mapel = $request->input('mapel');
        $jumlah = $request->input('jumlah', 10);
        $kategori = $mapel === 'TPA' ? 'TPA' : 'Akademik';

        $existingQuestions = Question::where('mapel', $mapel)->pluck('soal')->toArray();
        $existingJson = json_encode($existingQuestions, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        $prompt = "Bertindaklah sebagai pembuat soal ujian yang profesional. Buatkan $jumlah soal pilihan ganda tingkat kesulitan 'Sulit' untuk mata pelajaran $mapel. \n\n"
                . "PENTING:\n"
                . "1. Soal-soal ini tidak boleh sama, mirip, atau memiliki makna yang serupa dengan daftar soal berikut yang sudah ada di database saya:\n"
                . $existingJson . "\n\n"
                . "2. Jika soal mengandung rumus Matematika, Fisika, atau angka/simbol kompleks, gunakan format LaTeX/MathJax. Gunakan pembatas \\( ... \\) untuk rumus di dalam baris teks (inline), atau $$ ... $$ untuk rumus di baris terpisah (blok).\n\n"
                . "Keluarkan hasil akhir HANYA dalam format JSON Array mentah, tanpa markdown, tanpa penjelasan lain. Struktur JSON wajib persis seperti ini untuk setiap soal:\n"
                . "[\n  {\n    \"kategori\": \"$kategori\",\n    \"mapel\": \"$mapel\",\n    \"tingkat_kesulitan\": \"Sulit\",\n    \"soal\": \"teks soal dengan \\( rumus \\)\",\n    \"pilihan_a\": \"pilihan A\",\n    \"pilihan_b\": \"pilihan B\",\n    \"pilihan_c\": \"pilihan C\",\n    \"pilihan_d\": \"pilihan D\",\n    \"jawaban\": \"A\",\n    \"bobot\": 4\n  }\n]";

        return response()->json(['prompt' => $prompt]);
    }

    public function importGeminiJson(Request $request)
    {
        $jsonString = $request->input('json_data');
        
        // Bersihkan string dari markdown json
        $jsonString = preg_replace('/```json\s*/', '', $jsonString);
        $jsonString = preg_replace('/```\s*/', '', $jsonString);
        
        // Perbaiki backslash tunggal dari LaTeX (\frac menjadi \\frac) agar JSON valid
        $jsonString = preg_replace('/(?<!\\\\)\\\\(?![\\\\"])/', '\\\\\\\\', $jsonString);

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
                    'bobot' => $q['bobot'] ?? 4
                ]);
                $imported++;
            }
        }

        return redirect()->back()->with('success', "Berhasil mengimpor $imported soal baru dari Gemini!");
    }
}
