<?php

namespace Pets\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'pets';

    public function type()
    {
        return $this->belongsTo(PetType::class, 'type_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
