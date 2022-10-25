<?php
namespace Products\Repositories;

use App\User;
use Products\Models\Products;
use File;

class ProductsRepository implements ProductsRepositoryInterface
{
    public function allData(){
        $products = Products::all();
        return $products;
    }

    public function getDataId($id){
        return Products::findOrfail($id);
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
        $product = new Products();

        $pathImage = public_path().'/uploads/backend/products/';
        File::makeDirectory($pathImage, $mode = 0777, true, true);
        if ($request->hasFile('product_image')){
            $imageName = time().'.'.request()->product_image->getClientOriginalExtension();
            $request->product_image->move($pathImage, $imageName);
            $product->product_image = $imageName;
        }else{
            $product->product_image = 'product.png';
        }

        $product->product_name = json_encode($request->product_name);
        $product->product_descriptions = json_encode($request->product_descriptions);
        $product->qty = $request->qty;
        $product->price = $request->price;
        $product->user_id = $request->user_id;
        $product->publish = $request->publish;
        $product->save();

    }

    public function updateData($request,$id)
    {
        $product = $this->getDataId($id);

        $product->product_name = json_encode($request->product_name);
        $product->product_descriptions = json_encode($request->product_descriptions);
        $product->qty = $request->qty;
        $product->price = $request->price;
        $product->user_id = $request->user_id;
        $product->publish = $request->publish;

        $product->save();

        $pathImage = public_path().'/uploads/backend/products/';
        File::makeDirectory($pathImage, $mode = 0777, true, true);

        if ($request->hasFile('product_image')){
            if($product->product_image != 'product.png'){
                $image_path = public_path($product->product_image);
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }
            $imageName = time().'.'.request()->product_image->getClientOriginalExtension();
            $request->product_image->move($pathImage, $imageName);
            $product->product_image = $imageName;
        }

        $product->save();
    }

    public function deleteData($id)
    {
        $product = $this->getDataId($id);
        if($product->product_image != 'product.png'){
            $image_path = public_path($product->product_image);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }
        $product->delete();

    }
}
