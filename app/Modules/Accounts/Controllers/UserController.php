<?php

namespace Accounts\Controllers;

use App\Http\Controllers\Controller;
use Accounts\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public $path;
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('auth');
        $this->path = 'Accounts::';
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $title = transWord('Users');
        $pages = [
            [transWord('Users'),'users']
        ];
        $users = $this->userRepository->allData();
        return view($this->path.'index',compact('users','pages','title'));
    }

    public function create()
    {
        $title = transWord('Create New User');
        $pages = [
            [transWord('Users'),'users'],
            [transWord('Create New User'),'create_users']
        ];
        $roles = Role::all();
        return view($this->path.'create',compact('roles','pages','title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|min:2|max:255',
            'last_name' => 'required|min:2|max:255',
            'address' => 'required|min:2|max:255',
            'birthdate' => 'required|min:2|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6|max:255',
            'mobile' => 'required|unique:users',
        ]);

        $this->userRepository->saveData($request);
        return redirect()->route('users')->with('success');
    }

    public function show($id)
    {
        $title =transWord('Show User Data');
        $user = $this->userRepository->getDataId($id);
        $pages = [
            [transWord('Users'),'users'],
            [$user->first_name.' '.$user->last_name,'']
        ];
        return view($this->path.'show',compact('user','pages','title'));
    }

    public function edit($id)
    {
        $title =transWord('Edit User Data');
        $user = $this->userRepository->getDataId($id);
        $showUrl = route('show_users', ['id'=>$user->id]);
        $pages = [
            [transWord('Users'),'users'],
            [$user->name,['show_users',$user->id]]
        ];
        $roles = Role::all();
        return view($this->path.'edit',compact('user','roles','pages','title'));
    }

    public function profile()
    {
        $title =transWord('Edit My Profile');
        $user = auth()->user();
        $pages = [
            [transWord('My Profile'),''],
        ];
        $roles = Role::all();
        return view($this->path.'profile',compact('user','roles','pages','title'));
    }

    public function update($id,Request $request)
    {
        $user = User::findOrfail($id);

        if ($request->password) {
            $request->validate([
                'first_name' => 'required|min:2|max:255',
                'last_name' => 'required|min:2|max:255',
                'address' => 'required|min:2|max:255',
                'birthdate' => 'required|min:2|max:255',
                'mobile' => 'unique:users,mobile,' . $user->id,
                'email' => 'unique:users,email,'.$user->id,
                'password' => 'confirmed|min:6|max:255',
            ]);
        }else{
            $request->validate([
                'first_name' => 'required|min:2|max:255',
                'last_name' => 'required|min:2|max:255',
                'address' => 'required|min:2|max:255',
                'birthdate' => 'required|min:2|max:255',
                'mobile' => 'unique:users,mobile,' . $user->id,
                'email' => 'unique:users,email,'.$user->id,
            ]);
        }

        $this->userRepository->updateData($request,$id);
        return redirect()->route('users')->with('success','');
    }

    public function destroy($id)
    {
        $this->userRepository->deleteData($id);
        return redirect()->route('users')->with('success','');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('website');
    }
}
