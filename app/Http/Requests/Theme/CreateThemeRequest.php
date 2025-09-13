<?php

namespace App\Http\Requests\Theme;

use App\DTOs\Theme\ThemeDTO;
use Illuminate\Foundation\Http\FormRequest;

class CreateThemeRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'string|max:255',
        ];
    }

    public function toDTO(): ThemeDTO
    {
        $data = $this->validated();

        return ThemeDTO::fromRequest($data);
    }
}
