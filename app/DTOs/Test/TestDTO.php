<?php

namespace App\DTOs\Test;

class TestDTO
{
    public function __construct(
        public readonly string $title,
        public readonly ?string $description,
        public readonly int $max_attempts,
        public readonly int $passing_score,
        public readonly int $theme_id,
        public readonly int $duration,
        public readonly int $author_id,
        public readonly array $questions,
    ) {}

    public static function fromRequest(array $data, int $authorId): self
    {
        return new self(
            $data['title'],
            $data['description'] ?? null,
            (int) $data['max_attempts'],
            (int) $data['passing_score'],
            (int) $data['theme_id'],
            (int) $data['duration'],
            $authorId,
            array_map(fn ($q) => QuestionDTO::fromArray($q), $data['questions'])
        );
    }
}
