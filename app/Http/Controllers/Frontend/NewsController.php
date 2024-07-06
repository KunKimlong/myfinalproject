<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function index(){
        $news = News::orderBy('id','desc')->get();
        return view('Frontend.news',compact('news'));
    }
    public function newsDetail($id){
        $old_viewer = News::select('viewer')->where('id',$id)->first();
        // return $old_viewer;
        News::where('id',$id)->update(['viewer'=>$old_viewer->viewer+1]);
        $news = News::find($id);
        return view('Frontend.new-detail',compact('news'));
    }
}
