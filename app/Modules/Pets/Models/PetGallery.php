<?php

namespace Pets\Models;
use Illuminate\Database\Eloquent\Model;

class PetGallery extends Model
{
    protected $table = 'pet_media';

    public function getMediaPathAttribute($value)
    {
        return \URL::asset('/').setPublic().'uploads/backend/pets/'.$value;
    }
}
