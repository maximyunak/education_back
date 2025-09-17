<?php

namespace App\DTOs\Test;

class QuestionDTO
{
    public function __construct(
        public readonly string $text,
        public readonly string $type,
        public readonly ?int $points,
        public readonly array $answers,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['text'],
            $data['type'],
            $data['points'] ?? 0,
            array_map(fn ($a) => AnswerDTO::fromArray($a), $data['answers'])
        );
    }
}
