<?php

namespace Blogs\Models;
use Illuminate\Database\Eloquent\Model;

class BlogGallery extends Model
{
    protected $table = 'blog_media';

    public function getMediaPathAttribute($value)
    {
        return \URL::asset('/').setPublic().'uploads/backend/blogs/'.$this->blog_id.'/'.$value;
    }
}
