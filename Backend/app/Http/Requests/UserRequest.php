<?php

namespace App\Http\Requests;

use App\Exceptions\UserException;
use Illuminate\Foundation\Http\FormRequest;
use stdClass;
use Throwable;

class UserRequest extends FormRequest
{
    /**
     * Rules for UserRequest.
     */
    private array $createRules = [
        'name'      => 'required|max:50',
        'email'     => 'required|email|max:255|unique:users,email',
        'password'  => 'required|max:50'
    ];
    /**
     * Rules for UserRequest.
     */
    private array $updateRules = [
        'name'      => 'sometimes|required|max:50',
        'email'     => 'sometimes|required|email|max:255|unique:users,email',
        'password'  => 'sometimes|required|max:50'
    ];
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return match ($this->method()) {
            'POST' => $this->getCreateRules(),
            'PUT'  => $this->getUpdateRules(),
        };
    }
    /**
     * Rules for user post request.
     */
    protected function getCreateRules(): array
    {
        return $this->createRules;
    }
    /**
     * Rules for user put request.
     */
    protected function getUpdateRules(): array
    {
        return $this->updateRules;
    }
}
