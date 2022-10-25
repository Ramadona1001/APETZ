<?php
namespace Orders\Repositories;

use App\User;
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
        $items = [];$total = 0;
        foreach ($request->products as $item) {
            if ( $item['qty'] > 0) {
                $items[] = [
                    'id' => $item['id'],
                    'price' => $item['price'],
                    'name' => $item['name'],
                    'qty' => $item['qty'],
                    'total' => $item['price'] * $item['qty'],
                ];
                $total = $total + ($item['price'] * $item['qty']);
            }
        }
        $order = new Orders();
        $order->user_id = $request->user;
        $order->products = json_encode($items);
        $order->total_amount = $total;
        $order->other_notes = $request->notes;
        $order->save();
    }

    public function updateData($request,$id)
    {
        $order = $this->getDataId($id);

        $order->product_name = json_encode($request->product_name);
        $order->product_descriptions = json_encode($request->product_descriptions);
        $order->qty = $request->qty;
        $order->price = $request->price;
        $order->user_id = $request->user_id;
        $order->publish = $request->publish;

        $order->save();

        $pathImage = public_path().'/uploads/backend/Orders/';
        File::makeDirectory($pathImage, $mode = 0777, true, true);

        if ($request->hasFile('product_image')){
            if($order->product_image != 'product.png'){
                $image_path = public_path($order->product_image);
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }
            $imageName = time().'.'.request()->product_image->getClientOriginalExtension();
            $request->product_image->move($pathImage, $imageName);
            $order->product_image = $imageName;
        }

        $order->save();
    }

    public function deleteData($id)
    {
        $order = $this->getDataId($id);
        if($order->product_image != 'product.png'){
            $image_path = public_path($order->product_image);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }
        $order->delete();

    }
}
