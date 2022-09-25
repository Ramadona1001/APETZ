<?php

namespace Blogs\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class BlogComment extends Model
{
    protected $table = 'blog_comments';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }
}
