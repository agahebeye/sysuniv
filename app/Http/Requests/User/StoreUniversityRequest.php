<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class StoreUniversityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users',
            'password' => ['sometimes', 'confirmed', Rules\Password::defaults()],
            'website' => ['sometimes', 'url'],
            'address' => ['sometimes', 'string'],

            'faculties' => ['sometimes', 'array'],
            'institutes' => ['sometimes', 'array'],
        ];
    }
}
