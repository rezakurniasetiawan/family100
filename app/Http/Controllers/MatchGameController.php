<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Team;
use App\Models\Question;
use App\Models\MatchGame;
use Illuminate\Http\Request;

class MatchGameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function general($id)
    {
        $teams = Team::get();
        $answers = Answer::where('question_id', $id)->get();

        return response()->json([
            'teams' => $teams,
            'answers' => $answers,
        ]);
    }

    public function checking()
    {
        $matchGame = MatchGame::latest()->first();
        return response()->json($matchGame);
    }

    public function rangking()
    {
        $teams = Team::orderBy('score', 'desc')->get();
        return response()->json([
            'teams' => $teams,
        ]);
    }

    public function segment()
    {
        $questions = Question::join('segments', 'questions.segment_id', '=', 'segments.id')
            ->select('questions.*', 'segments.segment_name as segment_name')
            ->get();
        return response()->json([
            'questions' => $questions,
        ]);
    }
}
