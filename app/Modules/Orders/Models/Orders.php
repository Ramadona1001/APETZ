<?php
namespace Orders\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Orders\Repositories\OrdersRepository;
use Products\Models\Products;

class Orders extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
