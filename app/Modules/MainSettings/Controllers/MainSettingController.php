<?php

namespace MainSettings\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MainSettings\Repositories\MainSettingRepository;

class MainSettingController extends Controller
{
    public $path;
    private $mainRepository;

    public function __construct(MainSettingRepository $mainRepository)
    {
        $this->middleware('auth');
        $this->path = 'MainSettings::';
        $this->mainRepository = $mainRepository;
    }

    public function index()
    {
        hasPermissions('show_settings');
        $title = transWord('Main Settings');
        $pages = [
            [transWord('Main Settings'),'mainsettings']
        ];
        $settings = $this->mainRepository->allData();
        return view($this->path.'index',compact('settings','pages','title'));
    }

    public function save(Request $request)
    {
        hasPermissions('save_settings');
        $this->mainRepository->saveData($request);
        return back()->with('success','');
    }
}
