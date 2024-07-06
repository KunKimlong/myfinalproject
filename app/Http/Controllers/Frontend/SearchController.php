<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\News;

class SearchController extends Controller
{
    public function index(Request $request){
        $search = $request->input('query');
        $products = Product::where("name","LIKE","%".$search."%")->get();
        $news = News::where('title','LIKE','%'.$search.'%')->get();
        return view("frontend.search", compact("products",'news'));
    }
}
