<?php

namespace App\Services;

use App\Repositories\ProductsRepository;

class ProductsService
{
    public function __construct(protected ProductsRepository $products) {}

    /**
     * Retorna los productos existentes.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->products->index();
    }

    /**
     * Almacena productos nuevos.
     *
     * @param  Array  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        return $this->products->store($data);
    }

    /**
     * Muestra el detalle de un producto.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        return $this->products->show($id);
    }

    /**
     * Actualiza la informacion de un producto.
     *
     * @param  int  $id 
     * @param  Array  $request 
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(int $id, array $data)
    {
        return $this->products->update($id, $data);
    }

    /**
     * Borra un producto.
     *
     * @param  int  $id 
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        return $this->products->destroy($id);
    }
}