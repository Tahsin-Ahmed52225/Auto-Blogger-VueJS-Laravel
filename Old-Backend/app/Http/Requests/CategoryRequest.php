<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Rules for CategoryRequest Create.
     */
    private array $createRules = [
        'category_name'         => 'required|unique:categories|max:255',
        'category_slug'         => 'required|unique:categories|max:255',
    ];
    /**
     * Rules for UserRequest Update.
     */
    private array $updateRules = [
        'category_name'         => 'sometimes|required|max:255',
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
        $this->updateRules['category_slug'] = 'sometimes|required|unique:categories,id,' . $this->id . '|max:255';
        return $this->updateRules;
    }
}
