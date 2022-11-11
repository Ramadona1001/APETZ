<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
use Blogs\Models\Blog;
use Blogs\Models\BlogComment;
use Orders\Models\Orders;
use Pages\Models\Page;
use Pets\Models\Pet;
use Products\Models\Products;
use Spatie\Permission\Models\Role;
use Translates\Models\Translate;
use UserStories\Models\UserStories;

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
        $components = [];

        $roles = Role::all();

        foreach ($roles as $role) {
            $role_count = User::whereHas('roles', function ($q) use ($role) {
                $q->Where('name', $role->name);
            })->count();
            array_push($components,
                [$role_count,transWord($role->name),'user-list-fill','primary','show_statistics_users']
            );
        }
        $users_count = User::count();
        $user_stories_count = UserStories::count();
        $posts_count = Blog::count();
        $comments_count = BlogComment::count();
        $pets_count = Pet::count();
        $products_count = Products::count();
        $orders_count = Orders::count();
        $page_count = Page::count();
        $translate_count = Translate::count();

        array_push($components,
            [$users_count,transWord('Users'),'user-list-fill','primary','show_statistics_users'],
            [$user_stories_count,transWord('Users Stories'),'note-add-fill','primary','show_statistics_users'],
            [$posts_count,transWord('Users Posts'),'file-text','primary','show_statistics_users'],
            [$comments_count,transWord('Posts Comments'),'comments','primary','show_statistics_users'],
            [$pets_count,transWord('Pets'),'b-uc','primary','show_statistics_users'],
            [$products_count,transWord('Products'),'card-view','primary','show_statistics_users'],
            [$orders_count,transWord('Orders'),'file-docs','primary','show_statistics_pages'],
            [$page_count,transWord('Pages'),'file-plus','primary','show_statistics_pages'],
            [$translate_count,transWord('Translates'),'globe','primary','show_statistics_translates'],
        );

        return view('backend.index',compact('components','pages','title'));
    }
}
