<?php

namespace UserStories\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use UserStories\Repositories\UserStoriesRepository;
use Illuminate\Support\Facades\Validator;
use File;

class UserStoriesController extends Controller
{
    public $path;
    private $userStoriesRepository;

    public function __construct(UserStoriesRepository $userStoriesRepository)
    {
        $this->middleware('auth');
        $this->path = 'UserStories::';
        $this->userStoriesRepository = $userStoriesRepository;
    }

    public function index()
    {
        hasPermissions('show_user_stories');
        $title = transWord('UserStories');
        $pages = [
            [transWord('UserStories'),'user_stories']
        ];
        $user_stories = $this->userStoriesRepository->allData();
        return view($this->path.'index',compact('user_stories','pages','title'));
    }

    public function create()
    {
        $title = transWord('Create New Story');
        $pages = [
            [transWord('Stories'),'user_stories'],
            [transWord('Create New Pet'),'create_stories']
        ];
        $users = $this->userStoriesRepository->allUsers();
        return view($this->path.'create',compact('pages','title','users'));
    }

    public function store(Request $request)
    {
        if ($request->story_file) {
            $validator = Validator::make($request->all(), [
                'story_file' => 'required|file|mimes:pdf,docx,png,jpg,jpeg,xlsx',
            ]);

            if ($request->hasFile('story_file')) {
                $pathImage = public_path().'/uploads/backend/users_stories/';
                File::makeDirectory($pathImage, $mode = 0777, true, true);
                $imageName = time().'.'.$request->story_file->getClientOriginalExtension();
                $request->story_file->move($pathImage, $imageName);
            }
        }
        if ($request->story_text) {
            $validator = Validator::make($request->all(), [
                'story_text' => 'required|max:100',
            ]);
        }





        $this->petRepository->saveData($request,null);
        return redirect()->route('pets')->with('success');
    }

    public function user($id)
    {
        hasPermissions('show_user_stories');
        $id = Crypt::decrypt($id);
        $title = transWord('UserStories');
        $pages = [
            [transWord('UserFollow'),'user_stories']
        ];
        $user_stories = $this->userStoriesRepository->getFollowerData($id);
        return view($this->path.'daily',compact('user_stories','pages','title'));
    }

    public function save(Request $request)
    {
        hasPermissions('save_user_stories');
        $this->userStoriesRepository->saveData($request);
        return back()->with('success','');
    }
}
