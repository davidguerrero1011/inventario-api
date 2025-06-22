<?php

namespace App\Services;

use App\Repositories\CategoriesRepository;

class CategoriesService
{
    public function __construct(protected CategoriesRepository $categories) {}

    /**
     * Retorna las categorias existentes.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->categories->index();
    }

    /**
     * Almacena categorias nuevas.
     *
     * @param  Array  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        return $this->categories->store($data);
    }

    /**
     * Muestra el detalle de una categoria.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        return $this->categories->show($id);
    }

    /**
     * Actualiza la informacion de la categoria.
     *
     * @param  int  $id 
     * @param  Array  $request 
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(int $id, array $data)
    {
        return $this->categories->update($id, $data);
    }

    /**
     * Borra una categoria.
     *
     * @param  int  $id 
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(int $id)
    {
        return $this->categories->delete($id);
    }
}