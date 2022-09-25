<?php

namespace Pets\Repositories;

interface PetRepositoryInterface
{
    public function allData();

    public function getDataId($id);

    public function saveData($request,$id=null);

    public function allTypes();

    public function allUsers();

    public function deleteData($id);
}
