<?php

namespace App\Http\Requests\Test;

use Illuminate\Foundation\Http\FormRequest;

class CreateTestRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'max_attempts' => ['required', 'integer'],
            'passing_score' => ['required', 'integer'],
            'theme_id' => ['required', 'exists:themes,id'],
            'duration' => ['required', 'integer'],

            'questions' => ['required', 'array'],
            'questions.*.text' => ['required', 'string'],
            'questions.*.type' => ['required', 'in:single,multiple'],
            'questions.*.points' => ['nullable', 'integer'],

            'questions.*.answers' => ['required', 'array'],
            'questions.*.answers.*.text' => ['required', 'string'],
            'questions.*.answers.*.is_correct' => ['required', 'boolean'],
        ];
    }
}
