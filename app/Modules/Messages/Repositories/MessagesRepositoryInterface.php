<?php

namespace Messages\Repositories;

interface MessagesRepositoryInterface
{
    public function allData();

    public function getDataId($id);

    public function deleteData($id);

    public function getChatMessages($chatId);

    public function sendMessage($request,$chatId);
}
