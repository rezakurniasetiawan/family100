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
            ['question' => 'What is the capital of Nigeria?', 'answer' => 'Abuja', 'points' => 10],
            ['question' => 'What is the capital of Ghana?', 'answer' => 'Accra', 'points' => 20],
            ['question' => 'What is the capital of South Africa?', 'answer' => 'Pretoria', 'points' => 30],
            ['question' => 'What is the capital of Kenya?', 'answer' => 'Nairobi', 'points' => 40],
            ['question' => 'What is the capital of Egypt?', 'answer' => 'Cairo', 'points' => 50],
            ['question' => 'What is the capital of Canada?', 'answer' => 'Ottawa', 'points' => 60],
            ['question' => 'What is the capital of Brazil?', 'answer' => 'Brasilia', 'points' => 70],
            ['question' => 'What is the capital of Japan?', 'answer' => 'Tokyo', 'points' => 80],
            ['question' => 'What is the capital of France?', 'answer' => 'Paris', 'points' => 90],
            ['question' => 'What is the capital of Australia?', 'answer' => 'Canberra', 'points' => 100],
        ];
        

        foreach ($questions as $question) {
            \App\Models\Question::create($question);
        }
    }
}
