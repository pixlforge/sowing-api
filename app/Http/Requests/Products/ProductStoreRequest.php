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
            'name.*' => 'nullable|string|min:2|max:255',
            'description' => 'required',
            'description.*' => 'nullable|string|min:5|max:10000',
            'price' => 'required|numeric|min:100|max:99995',
            'category_id' => 'required|exists:categories,id'
        ];
    }
}
