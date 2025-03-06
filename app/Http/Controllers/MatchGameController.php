<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Question;
use App\Models\MatchGame;
use Illuminate\Http\Request;

class MatchGameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::get();
        $questions = Question::get();

        return response()->json([
            'teams' => $teams,
            'questions' => $questions
        ]);
    }

    public function checking(){
        $matchGame = MatchGame::latest()->first();
        return response()->json($matchGame);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
