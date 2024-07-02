<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Rules for PostRequest Create.
     */
    private array $createRules = [
        'title'         => 'required|unique:posts|max:255',
        'cover_image'   => 'required|max:255',
        'description'   => 'required',
        'user_id'       => 'required|exists:users,id',
        'status'        => 'required',
        'categories'    => 'array',
        'categories.*'  => 'exists:categories,id'
    ];
    /**
     * Rules for UserRequest Update.
     */
    private array $updateRules = [
        'title'         => 'sometimes|required|unique:posts|max:255',
        'cover_image'   => 'sometimes|required|max:255',
        'description'   => 'sometimes|required',
        'user_id'       => 'sometimes|required|exists:users,id',
        'status'        => 'sometimes|required',
        'categories'    => 'sometimes|array',
        'categories.*'  => 'exists:categories,id'
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
     * Rules for PostRequest.
     */
    protected function getCreateRules()
    {
        return $this->createRules;
    }
    /**
     * Rules for PostRequest.
     */
    protected function getUpdateRules()
    {
        return $this->updateRules;
    }
    protected function prepareForValidation(): void
    {
        $this->merge(json_decode($this->payload, true, 512, JSON_THROW_ON_ERROR));
    }
}
