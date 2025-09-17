<?php

namespace App\Services\Test;

use App\DTOs\Test\TestDTO;
use App\Models\Test;
use Illuminate\Support\Facades\DB;

class TestService
{
    public function __construct() {}

    public function store(TestDTO $dto)
    {
        return DB::transaction(function () use ($dto) {
            $test = Test::create([
                'title' => $dto->title,
                'description' => $dto->description,
                'max_attempts' => $dto->max_attempts,
                'passing_score' => $dto->passing_score,
                'theme_id' => $dto->theme_id,
                'duration' => $dto->duration,
                'author_id' => $dto->author_id,
            ]);

            foreach ($dto->questions as $questionDTO) {
                $question = $test->questions()->create([
                    'text' => $questionDTO->text,
                    'type' => $questionDTO->type,
                    'points' => $questionDTO->points,
                ]);

                foreach ($questionDTO->answers as $answerDTO) {
                    $question->answers()->create([
                        'text' => $answerDTO->text,
                        'is_correct' => $answerDTO->is_correct,
                    ]);
                }
            }

            return $test->load('questions.answers');
        });
    }
}
