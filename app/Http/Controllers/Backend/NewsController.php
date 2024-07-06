<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Exception;

class NewsController extends Controller
{
    public function index(){
        $news = News::get();
        return view('Backend.News.view-news',compact('news'));
    }
    public function openAdd(){
        return view('Backend.News.add-news');
    }
    public function create(Request $request){
        $title = $request->title;
        $thumbnail = $request->thumbnail;
        $description = $request->description;

        if($thumbnail){
            $thumbnailName = rand(1,99999).'_'.$thumbnail->getClientOriginalName();
            $thumbnail->move('Images',$thumbnailName);
        }

        try {
            News::Create([
                'title'=>$title,
                'viewer'=>0,
                'thumbnail'=>$thumbnailName,
                'description'=>$description,
            ]);
            return redirect()->route('addNews')->with('success','News Create Sucessfuly');
        } catch (Exception $e) {
            return redirect()->route('addNews')->with('error','Please enter all data');
        }
    }
    public function openUpdate($id){
        $news = News::find($id);
        return view('Backend.News.update-news',compact('news'));
    }
    public function update(Request $request){
        $id = $request->id;
        $title = $request->title;
        $thumbnail = $request->thumbnail;
        $description = $request->description;

        if($thumbnail){
            $thumbnailName = rand(1,99999).'_'.$thumbnail->getClientOriginalName();
            $thumbnail->move('Images',$thumbnailName);
        }
        else{
            $thumbnailName = $request->old_thumbnail;
        }
        try{
            News::where('id',$id)->update([
                'title'=>$title,
                'viewer'=>0,
                'thumbnail'=>$thumbnailName,
                'description'=>$description,
            ]);
            return redirect()->route('openUpdateNews',$id)->with('success','News is updated successfuly');
        }catch(Exception $e){
            return redirect()->route('openUpdateNews',$id)->with('error','please enter all data');
        }
    }
    public function delete(Request $request){
        $id = $request->remove_id;
        News::where('id',$id)->delete();
        return redirect()->route('viewNews',$id)->with('success','News is updated successfuly');
    }
}
