<?php

namespace App\DTOs\Auth;

class RegisterDTO
{
    public function __construct(
        public readonly string $first_name,
        public readonly string $last_name,
        public readonly ?string $middle_name,
        public readonly string $email,
        public readonly string $phone,
        public readonly string $password,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            first_name: $data['first_name'],
            last_name: $data['last_name'],
            middle_name: $data['middle_name'] ?? null,
            email: $data['email'],
            phone: $data['phone'],
            password: $data['password'],
        );
    }
}
