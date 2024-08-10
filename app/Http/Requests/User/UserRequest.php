<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'name'  => ['string', 'required'],
            'email' => [
                'string',
                'required',
                Rule::unique('users', 'email')->ignore(request()->route('user_id')),
            ],
            'password' => 'required',
        ];

        //        if (!is_null(request()->route('user_id'))) {
        //            $rules['email'][] = 'unique:users,email';
        //        }

        return $rules;
    }
}
