<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
    public function index(Request $request){
        $cate = $request->cate;
        $price = $request->price;
        $promotion = $request->promotion;
        $page = $request->page;

        if($request->cate){
            $total    = Product::where('categoryId','=',$request->cate)->count('id');
            $totalPage = ceil($total/3);
            $rsProduct = ($page-1)*3;
            $products = Product::orderBy("id","desc")->where('categoryId','=',$request->cate)->offset($rsProduct)->limit(3)->get();
        }
        else if($request->price=="min"){
            $total    = Product::count('id');
            $totalPage = ceil($total/3);
            $rsProduct = ($page-1)*3;
            $products = Product::orderBy('salePrice','asc')->offset($rsProduct)->limit(3)->get();
        }
        else if($request->price=="max"){
            $total    = Product::count('id');
            $totalPage = ceil($total/3);
            $rsProduct = ($page-1)*3;
            $products = Product::orderBy('salePrice','DESC')->offset($rsProduct)->limit(3)->get();
        }
        else if($request->promotion){
            $total    = Product::whereRaw('regularPrice != salePrice')->count('id');
            $totalPage = ceil($total/3);
            $rsProduct = ($page-1)*3;
            $products = Product::whereRaw('regularPrice != salePrice')->offset($rsProduct)->limit(3)->get();
        }
        else{
            $total    = Product::count('id');
            $totalPage = ceil($total/3);
            $rsProduct = ($page-1)*3;
            $products = Product::orderBy("id","desc")->offset($rsProduct)->limit(3)->get();
        }

        $categories = Category::get();

        return view("frontend.shop",compact("products",'cate','price','promotion',"categories",'totalPage'));
    }
}
