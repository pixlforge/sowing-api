<?php

namespace App\Http\Requests\Addresses;

use Illuminate\Foundation\Http\FormRequest;

class AddressStoreRequest extends FormRequest
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
            'first_name' => 'required|string|min:2|max:255',
            'last_name' => 'required|string|min:2|max:255',
            'company_name' => 'nullable|string|min:2|max:255',
            'address_line_1' => 'required|string|min:2|max:255',
            'address_line_2' => 'nullable|string|min:2|max:255',
            'postal_code' => 'required|string|min:4|max:255',
            'city' => 'required|string|min:2|max:255',
            'country_id' => 'required|exists:countries,id',
            'is_default' => 'nullable'
        ];
    }
}
