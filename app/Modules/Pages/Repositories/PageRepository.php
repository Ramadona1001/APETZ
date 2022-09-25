<?php


namespace Pages\Repositories;

use Pages\Models\Page;
use File;

class PageRepository implements PageRepositoryInterface
{
    public function allData(){
        return Page::all();
    }

    public function dataWithConditions( $conditions){
        $wheres = '';
        foreach ($conditions as $key => $value){
            $wheres .= '->where("'.$key.'","'.$key.'")';
        }
        $wheres = str_replace("'","",$wheres);
        return Page::$wheres->get();
    }

    public function getDataId($id){
        return Page::findOrfail($id);
    }

    public function saveData($request,$id = null)
    {

        if ($id == null) {
           $page = new Page();
        }else{
            $page = Page::findOrfail($id);
        }
        $page->title = json_encode($request->title);
        $page->slug = json_encode($request->slug);
        $page->content = json_encode($request->content);
        $page->publish = $request->publish;

        $pathImage = public_path().'/uploads/backend/pages/';
        File::makeDirectory($pathImage, $mode = 0777, true, true);

        if ($request->image != null) {
            if ($request->hasFile('image')){
                $imageName = time().'.'.request()->image->getClientOriginalExtension();
                $request->image->move($pathImage, $imageName);
                $page->image = $imageName;
            }
        }

        if(isset($request->meta_title))
            $page->meta_title = json_encode($request->meta_title);
        if(isset($request->meta_desc))
            $page->meta_desc = json_encode($request->meta_desc);
        if(isset($request->meta_keywords))
            $page->meta_keywords = json_encode($request->meta_keywords);
        $page->save();

    }

    public function deleteData($id)
    {
        $page = Page::findOrfail($id);
        File::deleteDirectory(public_path('uploads/backend/pages'.$page->image));
        $page->delete();
    }
}
