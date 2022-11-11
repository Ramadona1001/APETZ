<?php
namespace Orders\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Orders\Repositories\OrdersRepository;
use Products\Models\Products;

class OrderItem extends Model
{
    protected $table = 'order_item';

    protected $fillable = ['order_id','product_id','total','qty'];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
