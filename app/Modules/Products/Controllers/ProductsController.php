<?php
namespace Products\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Products\Requests\ProductsRequest;
use Products\Repositories\ProductsRepository;
use Crypt;

class ProductsController extends Controller
{
	public $path;
	private $productsRepository;
	public function __construct(ProductsRepository $productsRepository)
	{
		$this->middleware('auth');
		$this->path = "Products::";
		$this->productsRepository = $productsRepository;
	}
	public function index()
	{
		hasPermissions("show_products");
		$title = transWord("Products");
		$pages = [
		[
            transWord("Products"),"products"]
		];
		$products = $this->productsRepository->allData();
		return view($this->path."index",compact("products","pages","title"));
	}
	public function create()
	{
		hasPermissions("create_products");
		$title = transWord("New Products");
		$pages = [
		[
            transWord("New Products"),"products"]
		];
        $vendors = $this->productsRepository->allVendors();
		return view($this->path."create",compact("pages","title","vendors"));
	}
	public function store(ProductsRequest $request)
	{
		hasPermissions("create_products");
		$this->productsRepository->saveData($request);
		return back()->with("success","");
	}
	public function edit($id)
	{
		hasPermissions("update_products");
		$id = Crypt::decrypt($id);
		$product = $this->productsRepository->getDataId($id);
		$title = transWord("Update Products Date");
		$pages = [
		[
            transWord("Update Products Date"),"products"]
		];
        $vendors = $this->productsRepository->allVendors();
		return view($this->path."edit",compact("product","pages","title","vendors"));
	}
	public function update(ProductsRequest $request,$id)
	{
		hasPermissions("update_products");
		$id = Crypt::decrypt($id);
		$this->productsRepository->saveData($request,$id);
		return back()->with("success","");
	}
    public function show($id)
	{
		hasPermissions("show_products");
		$id = Crypt::decrypt($id);
		$product = $this->productsRepository->getDataId($id);
		$title = transWord("Show Products Data");
		$pages = [
		[
            transWord("Show Products Data"),"products"]
		];
		return view($this->path."show",compact("product","pages","title"));
	}
	public function destroy($id)
	{
		hasPermissions("delete_products");
		$id = Crypt::decrypt($id);
		$this->productsRepository->deleteData($id);
		return back()->with("success","");
	}
}
