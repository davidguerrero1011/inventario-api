<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoriesRequest extends FormRequest
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
            'name'        => 'required|unique:categories,name,' . $this->route('id'),  //Para excluir el ID Actual
            'description' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'name.required'        => 'El nombre de la categoría es obligatorio',
            'name.unique'          => 'Ya existe una categoría con este nombre',
            'description.required' => 'La descripción es obligatoria',
            'description.string'   => 'La descripción debe ser un texto',
        ];
    }
}
