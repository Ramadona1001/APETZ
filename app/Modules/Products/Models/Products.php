<?php
namespace Products\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Products\Repositories\ProductsRepository;

class Products extends Model
{
    public function getProductImageAttribute($value)
    {
        return \URL::asset('/').setPublic().'uploads/backend/products/'.$value;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
