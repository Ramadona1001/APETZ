<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Composer;

class NIIA_SETUP extends Command
{
    protected $signature = 'install:niia';
    protected $description = 'Command description';

    public function __construct(Composer $composer)
    {
        parent::__construct();
        $this->composer = $composer;
    }


    public function handle()
    {
        $db_tables = \DB::select('SHOW TABLES');
        if (count($db_tables) > 0) {
            $tables = [];
            foreach ($db_tables as $t) {
                \DB::select('DROP TABLE '.$t->Tables_in_niia);
            }
        }

        $this->composer->dumpAutoloads();
        $this->composer->dumpOptimized();
        Artisan::call('cache:clear');
        Artisan::call('migrate:refresh');
        Artisan::call('db:seed --class=UserSeeder');
        Artisan::call('db:seed --class=PermissionSeed');
        Artisan::call('db:seed --class=RoleSeeder');
        Artisan::call('db:seed --class=MainSettingSeeder');
        Artisan::call('cache:clear');
        echo "NIIA is installed successfully Please run 'php artisan serve' to show project";
    }
}
