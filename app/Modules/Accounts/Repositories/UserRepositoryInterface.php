<?php

namespace Accounts\Repositories;

interface UserRepositoryInterface
{
    public function allData();

    public function getDataId($id);

    public function saveData($request);

    public function updateData($request,$id);

    public function deleteData($id);
}
