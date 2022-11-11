<?php
namespace Orders\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Orders\Repositories\OrdersRepository;
use Products\Models\Products;

class Orders extends Model
{
    protected $appends = ['total'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function getStatusAttribute($value)
    {
        $status = [
            0=>transWord('Ordered'),
            1=>transWord('In Progress'),
            2=>transWord('Shipping'),
            3=>transWord('Delivered'),
        ];
        return $status[$value];
    }

    public function getTotalAttribute(){
        return OrderItem::where('order_id',$this->id)->sum('total');
    }
}
