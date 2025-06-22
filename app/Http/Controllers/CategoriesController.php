<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriesRequest;
use App\Http\Requests\UpdateCategoriesRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoriesService;

class CategoriesController extends Controller
{

    public function __construct(protected CategoriesService $categories) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->categories->index();
        if ($categories->isEmpty()) {
            return response()->json(['message' => 'No hay categorias que mostrar'], 200);
        }

        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriesRequest $request)
    {
        $categories = $this->categories->store($request->validated());
        return response()->json(['message' => 'Categoria creada de manera exitosa', 'category' => $categories], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $categories = $this->categories->show($id);
        if (!$categories) {
            return response()->json('No se encontro la categoria con identificador ' . $id);
        }

        return new CategoryResource($categories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriesRequest $request, int $id)
    {
        $category = $this->categories->update($id, $request->validated());
        if (!$category) {
            return response()->json(['message' => 'Categoria para actualizar no encontrada'], 404);
        }

        return response()->json(['message' => 'La categoria fue actualizada exitosamente', 'categories' => $category]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $category = $this->categories->delete($id);
        if (!$category) {
            return response()->json(['message' => 'Categoria para eliminar no encontrada'], 404);
        }

        return response()->json(['message' => 'La categoria fue borrada exitosamente']);
    }
}