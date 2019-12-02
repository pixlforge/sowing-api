<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'name.fr' => 'sometimes|required_without_all:name.en,name.de,name.it',
            'name.en' => 'sometimes|required_without_all:name.fr,name.de,name.it',
            'name.de' => 'sometimes|required_without_all:name.fr,name.en,name.it',
            'name.it' => 'sometimes|required_without_all:name.fr,name.en,name.de',
            'name.*' => 'nullable|string|min:2|max:255',
            'description.fr' => 'sometimes|required_without_all:description.en,description.de,description.it',
            'description.en' => 'sometimes|required_without_all:description.fr,description.de,description.it',
            'description.de' => 'sometimes|required_without_all:description.fr,description.en,description.it',
            'description.it' => 'sometimes|required_without_all:description.fr,description.en,description.de',
            'description.*' => 'nullable|string|min:5|max:10000',
            'category_id' => 'required_without:price|exists:categories,id',
            'price' => 'required_without:category_id|numeric|min:100|max:99995',
        ];
    }
}
