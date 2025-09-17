<?php

namespace App\Http\Requests\Auth;

use App\DTOs\Auth\LoginDTO;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string|max:255',
            'password' => 'required|string|between:3,255',
        ];
    }

    public function toDTO(): LoginDTO
    {
        return LoginDTO::fromRequest($this->validated());
    }
}
