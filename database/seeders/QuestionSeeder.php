<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            [
                'question' => 'What is the name of your first pet?',
                'status' => 'Active'
            ],
            [
                'question' => 'In which city were you born?',
                'status' => 'Active'
            ],
            [
                'question' => 'What is your favorite movie?',
                'status' => 'Active'
            ],
            [
                'question' => 'What is the name of your favorite teacher?',
                'status' => 'Active'
            ],
            [
                'question' => 'What was the make and model of your first car?',
                'status' => 'Active'
            ],
            [
                'question' => 'What is your favorite food?',
                'status' => 'Active'
            ],
            [
                'question' => 'What is the name of your childhood best friend?',
                'status' => 'Active'
            ],
        ];

        foreach ($questions as $questionData) {
            Question::create($questionData);
        }
    }
}
