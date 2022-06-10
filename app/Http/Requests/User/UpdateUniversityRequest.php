<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class UpdateUniversityRequest extends FormRequest
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

    public function getSafeData()
    {
        return $this->safe()->collect()->reject(fn ($value) => is_null($value))->toArray();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'string|max:255|nullable',
            'email' => 'string|email|max:255|nullable',
            'password' => ['confirmed', Rules\Password::defaults(), 'nullable'],
            'website' => ['url', 'nullable'],
            'address' => ['string', 'nullable'],

            'faculties' => ['array', 'nullable'],
            'institutes' => ['array', 'nullable'],
            'departments' => ['array', 'nullable'],
        ];
    }
}
