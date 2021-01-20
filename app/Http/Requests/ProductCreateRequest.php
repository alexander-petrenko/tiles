<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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
            'code' => ['required', 'string', 'unique:products,code'],
            'price' => ['required', 'numeric', 'between:0,999999.99'],
            'category' => ['required', 'array'],
            'collection' => ['required', 'integer'],
            'color' => ['required', 'string', 'min:3', 'max:50'],
            'shape' => ['required', 'integer'],
            'material' => ['required', 'integer'],
            'surface' => ['required', 'integer'],
            'style' => ['required', 'integer'],
            'length' => ['required', 'integer', 'min:0', 'max:2000'],
            'width' => ['required', 'integer', 'min:0', 'max:2000'],
            'weight' => ['required', 'integer', 'min:0', 'max:100000'],
            'in_box' => ['required', 'integer', 'min:0', 'max:100000'],
            'views' => ['nullable', 'integer', 'min:0', 'max:1000000'],
            'image' => ['required', 'image', 'mimes:jpeg,png']
        ];
    }
}
