<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoriesRequest extends FormRequest
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
            'name'        => 'required|unique:categories',
            'description' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required'        => 'El nombre de la categoria es obligatorio',
            'name.unique'          => 'Esta categoria ya fue creada, cambia el nombre',
            'description.required' => 'El nombre de la descripción es obligatoria',
            'description.string'   => 'El nombre de la descripción debe contener solo letras',
        ];
    }
}
