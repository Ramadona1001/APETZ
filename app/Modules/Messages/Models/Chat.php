<?php

namespace Messages\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Chat extends Model
{
    protected $table = 'chats';

    public function getSendAttribute($value)
    {
        return User::findOrfail($value);
    }

    public function getReceiveAttribute($value)
    {
        return User::findOrfail($value);
    }
}
