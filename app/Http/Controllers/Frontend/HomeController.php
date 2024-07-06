<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(){
        $promotion = Product::whereRaw('salePrice <> regularPrice')
                    ->orderBy('id','desc')
                    ->limit(4)->get();
        $newProduct = Product::orderBy('id','desc')->limit(4)->get();
        $popularProduct = Product::orderBy('viewer','desc')->limit(4)->get();
        return view("frontend.index",compact('promotion','newProduct','popularProduct'));
    }
    public function productDetail($id){
        $product = Product::with('colors','sizes')
                    ->where('products.id',$id)->first();
        // return $product->categoryId;
        $related_product = Product::where('categoryId',"=", $product->categoryId)->limit(4)->get();

        Product::where('id',$id)->update([
            'viewer'=>$product->viewer+1,
        ]);

        return view('frontend.product-detail',compact('product','related_product'));
    }
}
