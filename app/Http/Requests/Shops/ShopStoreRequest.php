<?php

namespace App\Http\Requests\Shops;

use Illuminate\Foundation\Http\FormRequest;

class ShopStoreRequest extends FormRequest
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
            'name' => 'required|string|unique:shops,name|min:2|max:255',
            'description_short' => 'required|min:2|max:3000',
            'description_long' => 'required|min:2|max:50000',
            'theme_color' => 'required',
            'postal_code' => 'required|string|min:4|max:10',
            'city' => 'required|string|min:2|max:255',
            'country_id' => 'required|exists:countries,id'
        ];
    }
}
