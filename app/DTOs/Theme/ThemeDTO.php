<?php

namespace App\DTOs\Theme;

class ThemeDTO
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $description,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'],
            description: $data['description'] ?? null,
        );
    }
}
