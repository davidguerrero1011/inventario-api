<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductsRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'stock'       => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'La categoria es obligatoria',
            'category_id.exists'   => 'La categoria debe existir en nuestro sistema',
            'name.required'        => 'El producto es obligatoria',
            'name.string'          => 'El producto debe tener solamente letras ',
            'name.max'             => 'El producto debe tener maximo 255 caracteres',
            'price.required'       => 'El precio es obligatoria',
            'price.min'            => 'El precio no puede ser un valor negativo',
            'price.regex'          => 'El precio debe tener 2 decimales unicamente',
            'stock.required'       => 'Debe ingresar la cantidad de manera obligatoria',
            'stock.numeric'        => 'La cantidad debe ser numerica',
            'stock.min'            => 'La cantidad no puede ser un valor negativo',
        ];
    }
}
