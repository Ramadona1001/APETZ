<?php

namespace Blogs\Controllers;

use App\Http\Controllers\Controller;
use Blogs\Repositories\BlogRepository;
use Blogs\Requests\BlogRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class BlogController extends Controller
{
    public $path;
    private $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->middleware('auth');
        $this->path = 'Blogs::';
        $this->blogRepository = $blogRepository;
    }

    public function index()
    {
        hasPermissions('show_blogs');
        $title = transWord('Posts');
        $pages = [
            [transWord('Posts'),'#']
        ];
        $blogs = $this->blogRepository->allData();
        return view($this->path.'index',compact('blogs','pages','title'));
    }

    public function create()
    {
        hasPermissions('create_blogs');
        $title = transWord('Create Post');
        $pages = [
            [transWord('All Posts'),'#'],
            [transWord('Create Posts'),'#']
        ];
        return view($this->path.'create',compact('pages','title'));
    }

    public function store(BlogRequest $request)
    {
        hasPermissions('create_blogs');
        $this->blogRepository->saveData($request,null);
        return back()->with('success','');
    }

    public function show($id)
    {
        hasPermissions('show_blogs');
        // $id = Crypt::decrypt($id);
        $blog = $this->blogRepository->getDataId($id);
        $comments = $this->blogRepository->blogComments($id);
        $title = transWord('Show Details');
        $pages = [
            [transWord('Blogs'),'#'],
        ];
        return view($this->path.'.show',compact('blog','title','pages','comments'));
    }

    public function edit($id)
    {
        hasPermissions('update_blogs');
        // $id = Crypt::decrypt($id);
        $blog = $this->blogRepository->getDataId($id);

        $title = transWord('Edit Data');
        $pages = [
            [transWord('Blogs'),'#'],
        ];
        return view($this->path.'.edit',compact('blog','title','pages'));
    }

    public function update(BlogRequest $request,$id)
    {
        hasPermissions('update_blogs');
        // $id = Crypt::decrypt($id);
        $this->blogRepository->saveData($request,$id);
        return back()->with('success','');
    }

    public function destroy($id){
        hasPermissions('delete_blogs');
        // $id = Crypt::decrypt($id);
        $this->blogRepository->deleteData($id);
        return back()->with('success','');
    }

    public function gallery($id)
    {
        $title =transWord('Post Gallery');
        $blog = $this->blogRepository->getDataId($id);
        $showUrl = route('show_blogs', ['id'=>$blog->id]);
        $pages = [
            [transWord('Posts'),'blog'],
            [$blog->name,['show_blogs',$blog->id]]
        ];
        $gallery = $this->blogRepository->viewGallery($id);
        return view($this->path.'gallery',compact('blog','pages','title','gallery'));
    }

    public function viewGallery($id)
    {
        $this->blogRepository->viewGallery($id);
    }

    public function uploadGallery(Request $request,$id)
    {
        $this->blogRepository->uploadGallery($request,$id);
    }

    public function destroyMedia($id)
    {
        $this->blogRepository->deleteMediaData($id);
        return back()->with('success','');
    }

    public function comments($id){
        hasPermissions('show_blogs_comments');
        // $id = Crypt::decrypt($id);
        $title = transWord('Post Comments');
        $pages = [
            [transWord('Post Comments'),'#'],
        ];
        $comments = $this->blogRepository->blogComments($id);
        return view($this->path.'.comments',compact('comments','title','pages'));
    }

    public function share($id){
        hasPermissions('show_blogs_share');
        // $id = Crypt::decrypt($id);
        $title = transWord('Post Share');
        $pages = [
            [transWord('Post Share'),'#'],
        ];
        $share = $this->blogRepository->blogShare($id);
        return view($this->path.'.share',compact('share','title','pages'));
    }

    public function publishComments($id,$publish){
        hasPermissions('publish_comments_blogs');
        // $id = Crypt::decrypt($id);
        $this->blogRepository->publishComments($id,$publish);
        return back()->with('success','');
    }

    public function destroyComments($id){
        hasPermissions('delete_comments_blogs');
        // $id = Crypt::decrypt($id);
        $this->blogRepository->deleteComments($id);
        return back()->with('success','');
    }

    public function reactions($id)
    {
        hasPermissions('show_blogs_reactions');
        $title =transWord('Post Reactions');
        $blog = $this->blogRepository->getDataId($id);
        $showUrl = route('show_blogs', ['id'=>$blog->id]);
        $pages = [
            [transWord('Posts'),'blogs'],
            [$blog->name,['show_blogs',$blog->id]]
        ];
        $reactions = $this->blogRepository->viewReactions($id);
        $reactions_statistics = $this->blogRepository->viewReactionStatistics($id);
        return view($this->path.'reactions',compact('blog','pages','title','reactions','reactions_statistics'));
    }
}
