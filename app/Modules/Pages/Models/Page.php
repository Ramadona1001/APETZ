<?php

namespace Pages\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function getImageAttribute($value)
    {
        return \URL::asset('/').setPublic().'uploads/backend/pages/'.$value;
    }
}
