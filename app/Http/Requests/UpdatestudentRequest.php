<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Governorate;
use App\Rules\AlphaSpace;

class UpdatestudentRequest extends FormRequest
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
        'nameEn' => ['required','max:255', new AlphaSpace],
        'nameAr' => ['required', 'max:255', 'regex:/^[\p{Arabic} ]+$/u'],
        'email' => [
                'required',
                Rule::unique('students')
                    ->ignore($this->student->id),
                Rule::email()
                    ->rfcCompliant(strict:true)
                    ->validateMxRecord()
            ],
        'birthDate' => ['required', 'date'],
        'governorate' => ['required', Rule::enum(Governorate::class)],
        'NationalId' => ['required', 'digits:14'],
        'photo' => ['image', 'max:2048'], 
        'phoneNumber' => ['required', 'size:11', 'regex: /^01[0125][0-9]{8}$/'],
        'studentStatus' => ['required', 'boolean'],
        'school' => ['required', 'max:255', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'nameAr.regex' => 'Enter your name With Arabic',
            'phoneNumber.regex' => 'A phone number should start with (010, 011, 012, 015)'
        ]; 
    }
}
