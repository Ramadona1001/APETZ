<?php
namespace Orders\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Orders\Requests\OrdersRequest;
use Orders\Repositories\OrdersRepository;
use Crypt;

class OrdersController extends Controller
{
	public $path;
	private $ordersRepository;
	public function __construct(OrdersRepository $ordersRepository)
	{
		$this->middleware("auth");
		$this->path = "Orders::";
		$this->ordersRepository = $ordersRepository;
	}
	public function index()
	{
		hasPermissions("show_orders");
		$title = transWord("Orders");
		$pages = [
		[
            transWord("Orders"),"orders"]
		];
		$orders = $this->ordersRepository->allData();
		return view($this->path."index",compact("orders","pages","title"));
	}
	public function create()
	{
		hasPermissions("create_orders");
		$title = transWord("New Orders");
		$pages = [
		[transWord("New Orders"),"orders"]
		];
        $products = $this->ordersRepository->products();
        $users = $this->ordersRepository->users();
		return view($this->path."create",compact("pages","title","products","users"));
	}
	public function store(Request $request)
	{
		hasPermissions("create_orders");
		$this->ordersRepository->saveData($request);
		return back()->with("success","");
	}
    public function show($id)
	{
		hasPermissions("show_orders");
		$id = Crypt::decrypt($id);
		$invoice = $this->ordersRepository->getDataId($id);
		$title = transWord("Show Orders Data");
		$pages = [
		[transWord("Show Orders Data"),"orders"]
		];
		return view($this->path."show",compact("invoice","pages","title"));
	}
    public function print($id)
	{
		hasPermissions("show_orders");
		$id = Crypt::decrypt($id);
		$invoice = $this->ordersRepository->getDataId($id);
		$title = transWord("Show Orders Data");
		$pages = [
		[transWord("Show Orders Data"),"orders"]
		];
		return view($this->path."print",compact("invoice","pages","title"));
	}
	public function edit($id)
	{
		hasPermissions("update_orders");
		$id = Crypt::decrypt($id);
		$order = $this->ordersRepository->getDataId($id);
		$title = transWord("Update Orders Data");
		$pages = [
		[transWord("Update Orders Data"),"orders"]
		];
        $products = $this->ordersRepository->products();
		return view($this->path."edit",compact("order","pages","title","products"));
	}
	public function update(Request $request,$id)
	{
		hasPermissions("update_orders");
		$id = Crypt::decrypt($id);
		$this->ordersRepository->updateData($request,$id);
		return back()->with("success","");
	}
	public function destroy($id)
	{
		hasPermissions("delete_orders");
		$id = Crypt::decrypt($id);
		$this->ordersRepository->deleteData($id);
		return back()->with("success","");
	}

    public function updateQuantity($item,Request $request)
    {
        $this->ordersRepository->updateOrderQty($item,$request);
        return back()->with("success","");
    }

    public function deleteOrderItem($item)
    {
        $check = $this->ordersRepository->deleteOrderItem($item);
        if ($check == 1) {
            return back()->with("success","");
        }else{
            return redirect()->route('orders');
        }
    }

    public function changeOrderStatus($order,$status)
    {
        $this->ordersRepository->changeOrderStatus($order,$status);
        return back()->with("success","");
    }
}
