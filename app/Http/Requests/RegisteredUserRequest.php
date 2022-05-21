<?php

namespace App\Http\Requests;

use App\Enums\UserType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Enum;

class RegisteredUserRequest extends FormRequest
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
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users',
            'password' => ['sometimes', 'confirmed', Rules\Password::defaults()],
            'role' => ['sometimes', new Enum(UserType::class)],
            'website' => ['sometimes', 'url'],
            'address' => ['sometimes', 'string'],
            'suspended' => ['sometimes', 'integer', Rule::in([0,1])],
        ];
    }
}
