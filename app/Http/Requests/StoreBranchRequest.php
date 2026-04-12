<?php

namespace App\Http\Requests;

use App\Rules\GoogleMapsUrl;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBranchRequest extends FormRequest
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
            'address' => ['required', 'string', 'max:255'],
            'phoneNumber' => ['required', 'string', 'size:11', 'regex:/^01(0|1|2|5)[0-9]{8}$/'],
            'email' => ['nullable', 'string', Rule::email()->rfcCompliant(strict: true)->validateMxRecord(), 'unique:branches',],
            'googleMapLink' => ['required', 'url', new GoogleMapsUrl],
            'isActive' => ['required', 'boolean'],
        ];
    }
}
