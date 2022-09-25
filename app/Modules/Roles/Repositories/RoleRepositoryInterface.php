<?php

namespace Roles\Repositories;

interface RoleRepositoryInterface
{
    public function allData();

    public function dataWithConditions($conditions);

    public function getDataId($id);

    public function saveData($request, $id = null);

    public function deleteData($id);

    public function getPermissions($id);

    public function assignPermissions($id, $request);
}
