<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
use Pages\Models\Page;
use Translates\Models\Translate;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = transWord('Home');
        $pages = [];

        $users_count = User::count();
        $instructors_count = User::whereHas('roles', function ($q) {
            $q->Where('name', 'Instructor');
        })->count();
        $students_count = User::whereHas('roles', function ($q) {
            $q->Where('name', 'Student');
        })->count();
        $page_count = Page::count();
        $translate_count = Translate::count();

        $components = [
            [$users_count,transWord('Users'),'user-list-fill','primary','show_statistics_users'],
            [$instructors_count,transWord('Instructors'),'user-list-fill','primary','show_statistics_instructors'],
            [$students_count,transWord('Students'),'user-list-fill','primary','show_statistics_students'],
            [$page_count,transWord('Pages'),'file-docs','primary','show_statistics_pages'],
            [$translate_count,transWord('Translates'),'globe','primary','show_statistics_translates'],

        ];

        //Course Category Pie Chart


        return view('backend.index',compact('components','pages','title'));
    }

    public function deleteMedia($id)
    {
        \DB::select('delete from studio where id = '.$id);
        return back();
    }
}
