<?php

namespace UserFollow\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserFollow extends Model
{
    protected $table = 'user_follows';

    public function user()
    {
        return $this->belongsTo(User::class, 'following');
    }

    public function follow()
    {
        return $this->belongsTo(User::class, 'follower');
    }
}
