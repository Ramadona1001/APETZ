<?php

namespace Blogs\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Blog extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function shareUser()
    {
        return $this->belongsTo(User::class, 'share_user');
    }
}
