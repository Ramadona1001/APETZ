<?php
namespace Products\Repositories;

interface ProductsRepositoryInterface
{
    public function allData();

    public function getDataId($id);

    public function saveData($request);

    public function updateData($request,$id);

    public function deleteData($id);
}
