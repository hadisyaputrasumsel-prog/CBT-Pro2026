<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

use App\Models\Participant;

class ExamController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function start(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'nullable|string|max:255',
        ]);

        $tpa_ids = Question::where('mapel', 'TPA')->inRandomOrder()->limit(50)->pluck('id')->toArray();
        $mapel_ids = [];
        $mapels = ['Matematika', 'IPA', 'Bahasa Indonesia', 'Bahasa Inggris'];
        foreach ($mapels as $mapel) {
            $ids = Question::where('mapel', $mapel)->inRandomOrder()->limit(50)->pluck('id')->toArray();
            $mapel_ids = array_merge($mapel_ids, $ids);
        }
        $questions_list = array_merge($tpa_ids, $mapel_ids);

        $participant = Participant::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'status' => 'mengerjakan',
            'questions_list' => $questions_list,
        ]);

        session(['participant_id' => $participant->id]);

        return redirect()->route('exam.index');
    }

    public function index()
    {
        if (!session()->has('participant_id')) {
            return redirect()->route('exam.welcome');
        }

        $participant = Participant::find(session('participant_id'));
        if (!$participant || !$participant->questions_list) {
            return redirect()->route('exam.welcome');
        }

        $questions = Question::whereIn('id', $participant->questions_list)->get();
        // Sort questions by mapel logically
        $questions = $questions->sortBy(function($q) {
            $order = ['TPA' => 1, 'Matematika' => 2, 'IPA' => 3, 'Bahasa Indonesia' => 4, 'Bahasa Inggris' => 5];
            return $order[$q->mapel] ?? 99;
        });

        $path = storage_path('app/settings.json');
        $menit_per_soal = 1;
        if (file_exists($path)) {
            $settings = json_decode(file_get_contents($path), true);
            $menit_per_soal = $settings['menit_per_soal'] ?? 1;
        }

        return view('exam', compact('questions', 'participant', 'menit_per_soal'));
    }

    public function submit(Request $request)
    {
        if (!session()->has('participant_id')) {
            return redirect()->route('exam.welcome');
        }

        $participant = Participant::find(session('participant_id'));
        if (!$participant || !$participant->questions_list) {
            return redirect()->route('exam.welcome');
        }

        $questions = Question::whereIn('id', $participant->questions_list)->get();
        $score = 0;
        $total_bobot = 0;
        $correct = 0;
        $wrong = 0;
        $unanswered = 0;
        $results = [];

        foreach ($questions as $q) {
            $ans = $request->input('q_' . $q->id);
            $bobot = $q->bobot;
            $total_bobot += $bobot;

            $is_correct = ($ans === $q->jawaban);

            if ($is_correct) {
                $score += $bobot;
                $correct++;
            } elseif ($ans !== null) {
                $wrong++;
            } else {
                $unanswered++;
            }

            $results[$q->id] = [
                'user_answer' => $ans,
                'correct_answer' => $q->jawaban,
                'is_correct' => $is_correct
            ];
        }

        $final_score = ($total_bobot > 0) ? round(($score / $total_bobot) * 100, 2) : 0;

        $time_taken = '0 detik';
        if ($participant) {
            $participant->update([
                'status' => 'selesai',
                'score' => $final_score
            ]);
            
            $duration_seconds = $participant->updated_at->diffInSeconds($participant->created_at);
            $hours = floor($duration_seconds / 3600);
            $minutes = floor(($duration_seconds % 3600) / 60);
            $seconds = $duration_seconds % 60;
            
            $time_parts = [];
            if ($hours > 0) $time_parts[] = $hours . ' jam';
            if ($minutes > 0) $time_parts[] = $minutes . ' menit';
            if ($seconds > 0 || empty($time_parts)) $time_parts[] = $seconds . ' detik';
            
            $time_taken = implode(' ', $time_parts);
        }

        session()->forget('participant_id');

        return view('result', compact('questions', 'score', 'total_bobot', 'correct', 'wrong', 'unanswered', 'results', 'final_score', 'time_taken'));
    }

    public function submitTab(Request $request)
    {
        if (!session()->has('participant_id')) {
            return response()->json(['error' => 'Session expired'], 401);
        }

        $participant = Participant::find(session('participant_id'));
        if (!$participant) {
            return response()->json(['error' => 'Participant not found'], 404);
        }

        $mapel = $request->input('mapel');
        $questions = Question::whereIn('id', $participant->questions_list)->where('mapel', $mapel)->get();
        
        $score = 0;
        $total_bobot = 0;
        $correct = 0;
        $wrong = 0;
        $unanswered = 0;
        $wrong_details = [];

        $path = storage_path('app/settings.json');
        $show_kunci = true;
        if (file_exists($path)) {
            $settings = json_decode(file_get_contents($path), true);
            $show_kunci = $settings['show_kunci_jawaban'] ?? true;
        }

        foreach ($questions as $q) {
            $ans = $request->input('q_' . $q->id);
            $bobot = $q->bobot;
            $total_bobot += $bobot;

            if ($ans === $q->jawaban) {
                $score += $bobot;
                $correct++;
            } elseif ($ans !== null) {
                $wrong++;
                $col_jawaban = 'pilihan_' . strtolower($q->jawaban);
                $col_ans = 'pilihan_' . strtolower($ans);
                $wrong_details[] = [
                    'soal' => $q->soal,
                    'kunci' => $show_kunci ? ($q->$col_jawaban ?? '-') : '*** Dirahasiakan ***',
                    'jawaban_user' => $q->$col_ans ?? '-',
                ];
            } else {
                $unanswered++;
            }
        }

        $final_score = ($total_bobot > 0) ? round(($score / $total_bobot) * 100, 2) : 0;
        
        $time_taken_seconds = $request->input('time_taken_seconds', 0);
        
        $tab_results = $participant->tab_results ?? [];
        $tab_results[$mapel] = [
            'score' => $final_score,
            'time_taken_seconds' => $time_taken_seconds,
            'correct' => $correct,
            'wrong' => $wrong,
            'unanswered' => $unanswered,
            'total' => $questions->count()
        ];
        
        $participant->tab_results = $tab_results;
        
        // Cek jika ini adalah tab kelima / terakhir yang disubmit (jika perlu)
        if (count($tab_results) >= 5) {
            $participant->status = 'selesai';
            // Hitung rata-rata final_score atau biarkan 0 jika tidak perlu
            $participant->score = collect($tab_results)->avg('score');
        }
        
        $participant->save();

        return response()->json([
            'mapel' => $mapel,
            'score' => $final_score,
            'correct' => $correct,
            'wrong' => $wrong,
            'unanswered' => $unanswered,
            'total' => $questions->count(),
            'wrong_details' => $wrong_details
        ]);
    }

    public function finishExam()
    {
        if (!session()->has('participant_id')) {
            return redirect()->route('exam.welcome');
        }

        $participant = Participant::find(session('participant_id'));
        if (!$participant) {
            return redirect()->route('exam.welcome');
        }

        $tab_results = $participant->tab_results ?? [];
        $totalScore = 0;
        foreach ($tab_results as $res) {
            $totalScore += $res['score'] ?? 0;
        }
        $avgScore = round($totalScore / 5, 2);

        $participant->update([
            'status' => 'selesai',
            'score' => $avgScore
        ]);

        session()->forget('participant_id');

        return redirect()->route('exam.welcome')->with('success', 'Ujian telah diakhiri. Terima kasih!');
    }
}
