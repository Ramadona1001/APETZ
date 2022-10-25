<?php
namespace Orders\Repositories;

interface OrdersRepositoryInterface
{
    public function allData();
    public function getDataId($id);
    public function saveData($request);
    public function updateData($request,$id);
    public function deleteData($id);
}
