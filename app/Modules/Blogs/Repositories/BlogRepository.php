<?php


namespace Blogs\Repositories;

use Blogs\Models\Blog;
use Blogs\Models\BlogComment;
use Blogs\Models\BlogGallery;
use Blogs\Models\BlogReaction;
use File;

class BlogRepository implements BlogRepositoryInterface
{
    public function allData(){
        return Blog::all();
    }

    public function dataWithConditions( $conditions){
        $wheres = '';
        foreach ($conditions as $key => $value){
            $wheres .= '->where("'.$key.'","'.$key.'")';
        }
        $wheres = str_replace("'","",$wheres);
        return Blog::$wheres->get();
    }

    public function getDataId($id){
        return Blog::findOrfail($id);
    }

    public function saveData($request,$id = null)
    {
        if ($id == null) {
            $blog = new Blog();
        }else{
            $blog = $this->getDataId($id);
        }
        $blog->title = json_encode($request->title);
        $blog->content = json_encode($request->content);
        $blog->publish = $request->publish;
        $blog->user_id = auth()->user()->id;
        $blog->save();
    }

    public function deleteData($id)
    {
        $pet = $this->getDataId($id);
        $media = BlogGallery::where('blog_id',$id)->get();
        foreach ($media as $img) {
            $media_explode = explode('/blogs/',$img->media_path)[1];
            $image_path = public_path('/uploads/backend/blogs/'.$id.'/'.$media_explode);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }
        $pet->delete();
    }

    public function viewGallery($id)
    {
        return BlogGallery::where('blog_id',$id)->get();
    }

    public function uploadGallery($request,$id)
    {
        $pathImage = public_path().'/uploads/backend/blogs/'.$id.'/';
        File::makeDirectory($pathImage, $mode = 0777, true, true);
        $gallery = new BlogGallery();
        $imageName = time().'.'.$request->file->getClientOriginalExtension();
        $request->file->move($pathImage, $imageName);
        $gallery->blog_id = $id;
        $gallery->media_path = $imageName;
        $gallery->save();
    }

    public function deleteMediaData($id)
    {
        $media = BlogGallery::findOrfail($id);
        $media_id = '/blogs/'.$media->blog_id.'/';
        $media_explode = explode($media_id,$media->media_path)[1];
        $image_path = public_path('/uploads/backend/blogs/'.$id.'/'.$media_explode);
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $media->delete();
    }

    public function blogComments($id)
    {
        return BlogComment::where('blog_id',$id)->get();
    }

    public function blogShare($id)
    {
        return Blog::where('share_blog',$id)->get();
    }

    public function publishComments($id,$publish)
    {
        $comment = BlogComment::findOrfail($id);
        $comment->publish = $publish;
        $comment->save();
    }

    public function deleteComments($id)
    {
        BlogComment::findOrfail($id)->delete();
    }

    public function viewReactions($id)
    {
        return BlogReaction::where('blog_id',$id)->get();
    }

    public function viewReactionStatistics($id)
    {
        return BlogReaction::select(\DB::raw('count(user_reaction) as count'),'user_reaction','blog_id')->groupBy('user_reaction')->havingRaw('blog_id = '.$id)->get();
    }
}
