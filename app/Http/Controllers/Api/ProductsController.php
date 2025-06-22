<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductsRequest;
use App\Http\Requests\UpdateProductsRequest;
use App\Http\Resources\ProductsResource;
use App\Services\ProductsService;

class ProductsController extends Controller
{

    public function __construct(protected ProductsService $products) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->products->index();
        if ($products->isEmpty()) {
            return response()->json(['No hay productos que mostrar']);
        }

        return ProductsResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductsRequest $request)
    {
        $products = $this->products->store($request->validated());
        return response()->json(['message' => 'El producto fue creado de manera exitosa', 'products' => $products], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $products = $this->products->show($id);
        if (!$products) {
            return response()->json('No se encontro el producto con identificador ' . $id);
        }

        return new ProductsResource($products);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductsRequest $request, int $id)
    {
        $products = $this->products->update($id, $request->validated());
        if (!$products) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        return response()->json(['message' => 'El producto fue actualizado exitosamente', 'products' => $products]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $product = $this->products->destroy($id);
        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        return response()->json(['message' => 'El producto fue borrado exitosamente']);
    }
}