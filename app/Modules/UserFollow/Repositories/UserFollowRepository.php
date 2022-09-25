<?php


namespace UserFollow\Repositories;

use UserFollow\Models\UserFollow;
use Request;
use UserFollow\Models\MainSetting;
use File;
use Carbon\Carbon;

class UserFollowRepository implements UserFollowRepositoryInterface
{
    public function allData(){
        return UserFollow::all();
    }

    public function getDataId($id){
        return UserFollow::findOrfail($id);
    }

    public function getFollowerData($id){
        return UserFollow::where('follower',$id)->get();
    }

    public function saveData($request)
    {
        $userFollow = new UserFollow();
        $userFollow->following = $request->following;
        $userFollow->url = $request->follower;
        $userFollow->save();
    }
}
