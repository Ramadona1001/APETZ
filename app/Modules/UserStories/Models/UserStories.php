<?php

namespace UserStories\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserStories extends Model
{
    protected $table = 'user_stories';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
