<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'name' => 'required',
            'name.fr' => 'required_without_all:name.en,name.de,name.it',
            'name.en' => 'required_without_all:name.fr,name.de,name.it',
            'name.de' => 'required_without_all:name.fr,name.en,name.it',
            'name.it' => 'required_without_all:name.fr,name.en,name.de',
            'name.*' => 'nullable|string|min:2|max:255',
            'description' => 'required',
            'description.fr' => 'required_without_all:description.en,description.de,description.it',
            'description.en' => 'required_without_all:description.fr,description.de,description.it',
            'description.de' => 'required_without_all:description.fr,description.en,description.it',
            'description.it' => 'required_without_all:description.fr,description.en,description.de',
            'description.*' => 'nullable|string|min:5|max:10000'
        ];
    }
}
