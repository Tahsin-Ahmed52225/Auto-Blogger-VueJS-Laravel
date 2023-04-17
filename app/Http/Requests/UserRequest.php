<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use App\Traits\ResponseAPI;

class UserRequest extends FormRequest
{
    use ResponseAPI;

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
            'email' => request()->route('user')
                ? 'required|email|max:255|unique:users,email,' . request()->route('user')
                : 'required|email|max:255|unique:users,email',
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
           "email.unique" => "Email has to be unique",
           "password.required" => "Password is required",
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->error($validator->errors(), 400)
        );
    }
}
