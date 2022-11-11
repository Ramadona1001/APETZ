<?php
namespace Orders\Repositories;

use App\User;
use Orders\Models\OrderItem;
use Orders\Models\Orders;
use Products\Models\Products;

class OrdersRepository implements OrdersRepositoryInterface
{
    public function allData(){
        $orders = Orders::all();
        return $orders;
    }

    public function getDataId($id){
        return Orders::findOrfail($id);
    }

    public function getItemDataId($id)
    {
        return OrderItem::findOrfail($id);
    }

    public function checkProductOrder($items,$product_id)
    {
        $item_id = 0;
        foreach ($items as $item) {
            if ($item->product_id == $product_id) {
                $item_id =  $item->id;
            }else{
                $item_id = 0;
            }
        }
        return $item_id;
    }

    public function getOrderItemsData($id)
    {
        return OrderItem::where('order_id',$id)->get();
    }

    public function products()
    {
        return Products::where('qty','>',0)->get();
    }

    public function users()
    {
        return User::all();
    }

    public function allVendors()
    {
        $users = User::whereHas('roles', function ($q) {
            $q->Where('name', 'Vendor');
        })->get();

        return $users;
    }

    public function saveData($request)
    {
        $order = new Orders();
        $order->user_id = $request->user;
        $order->other_notes = $request->notes;
        $order->save();

        foreach ($request->products  as $product) {
            if ( $product['qty'] > 0) {
                $item = new OrderItem();
                $item->order_id = $order->id;
                $item->product_id = $product['id'];
                $item->qty = $product['qty'];
                $item->total = $product['qty'] * $product['price'];
                $item->save();
            }
        }
    }

    public function updateData($request,$id)
    {
        $order = $this->getDataId($id);
        $items = $this->getOrderItemsData($id);

        foreach ($request->products  as $product) {
            if ( $product['qty'] > 0) {
                $item_id = $this->checkProductOrder($items,$product['id']);
                if ($item_id > 0) {
                    $item = $this->getItemDataId($item_id);
                    $item->qty = $product['qty'] + $item->qty;
                    $item->total = $item->total + ($product['qty'] * $product['price']);
                    $item->save();
                }else{
                    $item = new OrderItem();
                    $item->order_id = $order->id;
                    $item->product_id = $product['id'];
                    $item->qty = $product['qty'];
                    $item->total = $product['qty'] * $product['price'];
                    $item->save();
                }
            }
        }
    }

    public function deleteData($id)
    {
        $order = $this->getDataId($id);
        $order->delete();
    }

    public function updateOrderQty($item_id,$request)
    {
        $item = $this->getItemDataId($item_id);
        $product = Products::findOrfail($item->product_id);
        $item->qty = $request->new_qty;
        $item->total = $request->new_qty * $product->price;
        $item->save();
    }

    public function deleteOrderItem($item_id)
    {
        $item = $this->getItemDataId($item_id);
        $order = $this->getDataId($item->order_id);
        $item->delete();
        if (count($this->getOrderItemsData($order->id)) > 0) {
            return 1;
        }else{
            $order->delete();
            return 0;
        }
    }

    public function changeOrderStatus($order,$status)
    {
        $order = $this->getDataId($order);
        $order->status = $status;
        $order->save();
    }
}
