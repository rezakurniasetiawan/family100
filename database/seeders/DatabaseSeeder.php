<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            // 'email' => 'wcuofficial@gmail.com',
            // 'password' => bcrypt('4ku4n4kindonesi4'),
        ]);

        // create teams
        $teams = [
            ['team_name' => 'Team 1'],
            ['team_name' => 'Team 2'],
            ['team_name' => 'Team 3'],
            ['team_name' => 'Team 4'],
        ];

        foreach ($teams as $team) {
            \App\Models\Team::create($team);
        }

        // create questions
        $questions = [
            ['question' => 'What is the capital of Nigeria?'],
            ['question' => 'What is the capital of Ghana?'],
            ['question' => 'What is the capital of South Africa?'],
            ['question' => 'What is the capital of Kenya?'],
            ['question' => 'What is the capital of Egypt?'],
            ['question' => 'What is the capital of Canada?'],
            ['question' => 'What is the capital of Brazil?'],
            ['question' => 'What is the capital of Japan?'],
            ['question' => 'What is the capital of France?'],
            ['question' => 'What is the capital of Australia?'],
        ];


        foreach ($questions as $question) {
            \App\Models\Question::create($question);
        }
    }
}
