<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:new_progress,completed,canceled',
        ];
    }

    /**
     * Custom validation error messages (optional but professional)
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Task title is required',
            'status.required' => 'Task status is required',
            'status.in' => 'Status must be new_progress, completed or canceled',
        ];
    }
}
