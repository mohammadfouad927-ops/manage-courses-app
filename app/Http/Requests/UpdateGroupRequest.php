<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGroupRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
         return [
            'name' => ['required', 'string', 'max:255'],
            'program_session_id' => ['required', 'exists:program_sessions,id'],
            'branch_id' => ['nullable', 'exists:branches,id'],
            'capacity' => ['required', 'integer', 'min:20'],
            'isActive' => ['required', 'boolean']
        ];
    }
}
