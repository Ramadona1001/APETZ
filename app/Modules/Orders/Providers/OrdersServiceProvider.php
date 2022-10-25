<?php
namespace Orders\Providers;
use Illuminate\Support\ServiceProvider;

class OrdersServiceProvider extends ServiceProvider
{
	public function register(){
	}
	public function boot(){
		$ds = DIRECTORY_SEPARATOR;
		$module = "Orders";
		$this->loadRoutesFrom(__DIR__.$ds."..".$ds."Routes".$ds."web.php");
		$this->loadMigrationsFrom(__DIR__.$ds."..".$ds."Database".$ds."migrations");
		$this->loadFactoriesFrom(__DIR__.$ds."..".$ds."Database".$ds."factories");
		$this->loadViewsFrom(__DIR__.$ds."..".$ds."Resources".$ds."views",$module);
		$this->loadTranslationsFrom(__DIR__.$ds."..".$ds."Resources".$ds."lang",$module);
	}
}