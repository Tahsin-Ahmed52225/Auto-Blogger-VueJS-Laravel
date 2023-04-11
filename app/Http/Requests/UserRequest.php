<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:50',
            'email' => 'required|max:50',
            'password' => request()->route('user') ? 'nullable' : 'required|max:50'
        ];
    }
         /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
      return  $message = [
           "name.required" => "Name is required",
           "email.required" => "Email is required",
           "password.required" => "Password is required",
        ];
    }
}
