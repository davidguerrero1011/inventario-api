<?php

namespace App\Repositories;

use App\Models\Products;
use Exception;

class ProductsRepository
{

    /**
     * Retorna los productos existentes.
     *
     * @return Collection
     */
    public function index()
    {
        try {
            return Products::with('category')->paginate(10);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Almacena productos nuevos.
     *
     * @param  Array  $request
     * @return Collection
     */
    public function store(array $data)
    {
        try {
            return Products::create($data);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Muestra el detalle de un producto.
     *
     * @param  int  $id
     * @return Collection
     */
    public function show(int $id)
    {
        try {
            return Products::with('category')->where('id', $id)->first();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Actualiza la informacion del producto.
     *
     * @param  int  $id 
     * @param  Array  $request 
     * @return Collection
     */
    public function update(int $id, array $data)
    {
        try {

            $product = Products::find($id);
            if (!$product) {
                return null;
            }

            $product->update($data);
            return $product;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Borra un producto.
     *
     * @param  int  $id 
     * @return Collection
     */
    public function destroy(int $id)
    {
        try {

            $product = Products::find($id);
            if (!$product) {
                return null;
            }

            $product->delete();
            return $product;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}