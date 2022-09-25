<?php

namespace UserFollow\Repositories;

interface UserFollowRepositoryInterface
{
    public function allData();
    public function getDataId($id);
    public function saveData($request);
    public function getFollowerData($id);
}
