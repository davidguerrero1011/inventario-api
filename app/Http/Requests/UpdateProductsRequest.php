<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductsRequest extends FormRequest
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
            'name'        => 'required|string|max:255|unique:products,name,' . $this->route('id'),
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'La categoría es obligatoria.',
            'category_id.exists'   => 'La categoría seleccionada no existe.',
            'name.required'        => 'El nombre del producto es obligatorio.',
            'name.unique'          => 'Ya existe un producto con este nombre.',
            'description.required' => 'La descripción del producto es obligatoria.',
            'price.required'       => 'El precio del producto es obligatorio.',
            'price.numeric'        => 'El precio debe ser númerico.',
            'price.min'            => 'El precio del producto no puede ser negativo.',
            'stock.required'       => 'El stock del producto es obligatorio.',
            'stock.integer'        => 'El stock del producto debe ser un número entero.',
            'stock.min'            => 'El stock del producto no puede ser negativo.',
        ];
    }
}
