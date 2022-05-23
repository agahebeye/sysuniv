<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class RegisteredStudentRequest extends FormRequest
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
            'firstname' => ['sometimes', 'string'],
            'lastname' => ['sometimes', 'string'],
            'gender' => ['sometimes', new Enum(GenderType::class)],
            'birth_date' => ['sometimes', 'date_format:Y-m-d'],
            'address' => ['sometimes', 'string'],

            'photo' => ['sometimes', 'image']
        ];
    }
}