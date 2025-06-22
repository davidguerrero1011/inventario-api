<?php

namespace App\Repositories;

use App\Models\Categories;
use Exception;

class CategoriesRepository
{

    /**
     * Retorna las categorias existentes.
     *
     * @return Collection
     */
    public function index()
    {
        return Categories::all();
    }

    /**
     * Almacena categorias nuevas.
     *
     * @param  Array  $request
     * @return Collection
     */
    public function store(array $data)
    {
        try {
            return Categories::create($data);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Muestra el detalle de una categoria.
     *
     * @param  int  $id
     * @return Collection
     */
    public function show($id)
    {
        try {
            return Categories::find($id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Actualiza la informacion de la categoria.
     *
     * @param  int  $id 
     * @param  Array  $request 
     * @return Collection
     */
    public function update($id, array $data)
    {
        try {

            $category = Categories::find($id);
            if (!$category) {
                return null;
            }

            $category->update($data);
            return $category;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Borra una categoria.
     *
     * @param  int  $id 
     * @return Collection
     */
    public function delete(int $id)
    {
        try {

            $category = Categories::find($id);
            if (!$category) {
                return null;
            }

            $category->delete();
            return $category;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}