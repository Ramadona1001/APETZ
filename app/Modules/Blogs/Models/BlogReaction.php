<?php

namespace Blogs\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class BlogReaction extends Model
{
    protected $table = 'blog_reactions';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }
}
