<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Allow all authenticated users to create projects
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'start_timestamp' => 'required|date|after_or_equal:now',
            'end_timestamp' => 'required|date|after:start_timestamp',
            'user_id' => 'required|integer|exists:users,id',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'The project title is required.',
            'title.max' => 'The project title must not exceed 255 characters.',
            'description.max' => 'The description must not exceed 1000 characters.',
            'start_timestamp.required' => 'The start date is required.',
            'start_timestamp.after_or_equal' => 'The start time must be in the future or now.',
            'end_timestamp.required' => 'The end date is required.',
            'end_timestamp.after' => 'The end time must be after the start time.',
            'user_id.required' => 'The user ID is required.',
            'user_id.exists' => 'The selected user does not exist.',
        ];
    }
}
