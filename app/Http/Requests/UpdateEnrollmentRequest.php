<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\PaymentStatus;

class UpdateEnrollmentRequest extends FormRequest
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
            'student_id' => ['required', 'exists:students,id'],
            'program_session_id' => ['required', 'exists:program_sessions,id'],
            'group_id' => ['required', Rule::exists('groups', 'id')->where(function($query){
                return $query->where('program_session_id', $this->program_session_id);
            })],
            'paymentStatus' => ['required', Rule::enum(PaymentStatus::class)]
        ];
    }

    public function messages(): array
    {
        return [
            'group_id.exists' => 'The selected group does not belong to the selected program session.',
        ];
    }
}
