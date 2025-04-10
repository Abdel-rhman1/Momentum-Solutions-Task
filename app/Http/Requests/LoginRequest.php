<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
class LoginRequest extends FormRequest
{
    use ApiResponse;
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
            'email'=>'required|email|exists:users,email',
            'password'=>'required|string|min:6',
        ];
    }

    public function failedValidation(Validator $validator){
        return $this->apiResponseValidation($validator);
    }
}
