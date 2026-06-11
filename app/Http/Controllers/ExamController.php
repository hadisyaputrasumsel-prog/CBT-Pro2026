<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class ExamController extends Controller
{
    public function index()
    {
        $questions = Question::all();
        return view('exam', compact('questions'));
    }

    public function submit(Request $request)
    {
        $questions = Question::all();
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

        return view('result', compact('questions', 'score', 'total_bobot', 'correct', 'wrong', 'unanswered', 'results', 'final_score'));
    }
}
