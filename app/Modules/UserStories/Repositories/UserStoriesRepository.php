<?php


namespace UserStories\Repositories;

use App\User;
use UserStories\Models\UserStories;
use Request;
use UserStories\Models\MainSetting;
use File;
use Carbon\Carbon;

class UserStoriesRepository implements UserStoriesRepositoryInterface
{
    public function allData(){
        return UserStories::all();
    }

    public function allUsers()
    {
        return User::all();
    }

    public function getDataId($id){
        return UserStories::findOrfail($id);
    }

    public function getFollowerData($id){
        return UserStories::where('follower',$id)->get();
    }

    public function saveData($request)
    {
        $user_stories = new UserStories();
        $user_stories->following = $request->following;
        $user_stories->url = $request->follower;
        $user_stories->save();
    }
}
