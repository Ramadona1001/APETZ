<?php

namespace UserFollow\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use UserFollow\Repositories\UserFollowRepository;

class UserFollowController extends Controller
{
    public $path;
    private $activityRepository;

    public function __construct(UserFollowRepository $activityRepository)
    {
        $this->middleware('auth');
        $this->path = 'UserFollow::';
        $this->activityRepository = $activityRepository;
    }

    public function index()
    {
        hasPermissions('show_user_follows');
        $title = transWord('UserFollow');
        $pages = [
            [transWord('UserFollow'),'user_follows']
        ];
        $user_follows = $this->activityRepository->allData();
        return view($this->path.'index',compact('user_follows','pages','title'));
    }

    public function user($id)
    {
        hasPermissions('show_user_follows');
        $id = Crypt::decrypt($id);
        $title = transWord('UserFollow');
        $pages = [
            [transWord('UserFollow'),'user_follows']
        ];
        $user_follows = $this->activityRepository->getFollowerData($id);
        return view($this->path.'daily',compact('user_follows','pages','title'));
    }

    public function save(Request $request)
    {
        hasPermissions('save_user_follows');
        $this->activityRepository->saveData($request);
        return back()->with('success','');
    }
}
