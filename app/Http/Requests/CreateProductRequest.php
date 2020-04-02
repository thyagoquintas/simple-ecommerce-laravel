<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:products|max:255',
            'image' => 'required',
            'description' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'stock' => 'required'
        ];
    }
}
