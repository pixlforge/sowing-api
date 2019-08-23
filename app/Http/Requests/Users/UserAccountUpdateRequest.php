<?php

namespace App\Http\Requests\Users;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserAccountUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'sometimes|required|string|min:2|max:255',
            'email' => [
                'sometimes', 'required', 'email',
                Rule::unique('users')->ignore($this->id)
            ],
            'password' => 'sometimes|required|string|confirmed|min:8|max:255'
        ];
    }
}
