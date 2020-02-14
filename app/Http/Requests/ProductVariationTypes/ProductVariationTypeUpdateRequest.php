<?php

namespace App\Http\Requests\ProductVariationTypes;

use Illuminate\Foundation\Http\FormRequest;

class ProductVariationTypeUpdateRequest extends FormRequest
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
            'name.*' => 'nullable|string|min:2|max:255',
            'name.fr' => 'required_without_all:name.en,name.de,name.it',
            'name.en' => 'required_without_all:name.fr,name.de,name.it',
            'name.de' => 'required_without_all:name.fr,name.en,name.it',
            'name.it' => 'required_without_all:name.fr,name.en,name.de',
        ];
    }
}
