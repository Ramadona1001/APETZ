<?php

namespace MainSettings\Repositories;

interface MainSettingRepositoryInterface
{
    public function allData();

    public function dataWithConditions($conditions);

    public function getDataId($id);

    public function saveData($request);
}
