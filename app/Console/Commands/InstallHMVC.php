<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use File;

class InstallHMVC extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:hmvc {keyword}';

    protected $description = 'Install HMVC Module';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $keyword = $this->argument('keyword');

        /*************** Modules Folders ***************/

        $module_folder = app_path().'/Modules/' . $keyword;
        File::makeDirectory($module_folder, $mode = 0777, true, true);

        $controller_folder = app_path().'/Modules/' . $keyword .'/Controllers';
        File::makeDirectory($controller_folder, $mode = 0777, true, true);

        $database_folder = app_path().'/Modules/' . $keyword .'/Database';
        File::makeDirectory($database_folder, $mode = 0777, true, true);

        $migration_folder = $database_folder .'/migrations';
        File::makeDirectory($migration_folder, $mode = 0777, true, true);

        $model_folder = app_path().'/Modules/' . $keyword .'/Models';
        File::makeDirectory($model_folder, $mode = 0777, true, true);

        $providers_folder = app_path().'/Modules/' . $keyword .'/Providers';
        File::makeDirectory($providers_folder, $mode = 0777, true, true);

        $repositories_folder = app_path().'/Modules/' . $keyword .'/Repositories';
        File::makeDirectory($repositories_folder, $mode = 0777, true, true);

        $requests_folder = app_path().'/Modules/' . $keyword .'/Requests';
        File::makeDirectory($requests_folder, $mode = 0777, true, true);

        $resources_folder = app_path().'/Modules/' . $keyword .'/Resources';
        File::makeDirectory($resources_folder, $mode = 0777, true, true);

        $views_folder = $resources_folder .'/views';
        File::makeDirectory($views_folder, $mode = 0777, true, true);

        $routes_folder = app_path().'/Modules/' . $keyword .'/Routes';
        File::makeDirectory($routes_folder, $mode = 0777, true, true);


        /**********************************************/

        /******************** Files **************************/
        //Make Controller
        // Artisan::call('make:controller App\\\Modules//'.$keyword.'//Controllers//'.$keyword.'Controller');
        writeModel($keyword);
        writeProviders($keyword);
        writeRepoistories($keyword);
        writeRepoistoriesInterface($keyword);
        writeController($keyword);
        writeRequest($keyword);
        writeRoutes($keyword);
    }
}
