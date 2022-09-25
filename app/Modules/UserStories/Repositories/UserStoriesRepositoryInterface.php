<?php

namespace UserStories\Repositories;

interface UserStoriesRepositoryInterface
{
    public function allData();
    public function getDataId($id);
    public function saveData($request);
    public function getFollowerData($id);
}
