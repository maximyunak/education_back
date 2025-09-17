<?php

namespace App\DTOs\Test;

class AnswerDTO
{
    public function __construct(
        public readonly string $text,
        public readonly ?bool $is_correct,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            text: $data['text'],
            is_correct: $data['is_correct'] ?? false,
        );
    }
}
