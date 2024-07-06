<?php

namespace App\Http\Controllers\Backend;

use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(){
        $products = Product::with('colors','sizes')
                    ->select('products.*','users.name as Username','categories.name as CateName','discounts.name as DiscountName')
                    ->join('users','products.userId','=','users.id')
                    ->join('categories','products.categoryId','=','categories.id')
                    ->join('discounts','products.discountID','=','discounts.id')
                    ->orderBy('id','desc')
                    ->get();
        $total = Product::count('id');
        $total_category = Category::withCount('products')->get();
        $category = [];
        foreach($total_category as $tCategory){
            array_push($category,"Category ".$tCategory->name.": ".$tCategory->products_count);
        }
        return view('backend.Product.view-product',compact('products','total','category'));
    }
    public function openAdd(){
        $discounts = Discount::get();
        $sizes     = Size::get();
        $colors    = Color::get();
        $categories  = Category::get();
        return view('Backend.Product.add-product',compact('discounts','sizes','colors','categories'));
    }
    public function create(Request $request){
        $name = $request->name;
        $qty = $request->qty;
        $regular_price = $request->regular_price;
        $discountid = $request->discount;
        $size = $request->size;
        $color = $request->color;
        $category = $request->category;
        $thumbnail = $request->thumbnail;
        $description = $request->description;

        $discount = Discount::find($discountid);

        if($thumbnail){
            $thumbnailName = rand(1,99999).'_'.$thumbnail->getClientOriginalName();
            $thumbnail->move('Images',$thumbnailName);
        }

        $sale_price = $regular_price-($regular_price*$discount->name/100);

        try{
            $product = Product::create([
                'name'=>$name,
                'qty'=>$qty,
                'thumbnail'=>$thumbnailName,
                'description'=>$description,
                'userId'=>Auth::user()->id,
                'categoryId'=>$category,
                'discountId'=>$discountid,
                'viewer'=>0,
                'salePrice'=>$sale_price,
                'regularPrice'=>$regular_price
            ]);
            $product->sizes()->attach($size);
            $product->colors()->attach($color);


            return redirect()->route('openAddProduct')->with('success','Product created successfully...!');
        }
        catch(Exception $e){
            return redirect()->route('openAddProduct')->with('error','Product can not create please try again');
        }


    }
    public function openUpdate($id){
        $product = Product::with('sizes','colors')->find($id);
        // return $product;
        $discounts = Discount::get();
        $sizes     = Size::get();
        $colors    = Color::get();
        $categories  = Category::get();
       return view('Backend.Product.update-product',compact('product','discounts','sizes','colors','categories'));
    }
    public function update(Request $request){
        $id = $request->id;
        $name = $request->name;
        $qty = $request->qty;
        $regular_price = $request->regular_price;
        $discountid = $request->discount;
        $size = $request->size;
        $color = $request->color;
        $category = $request->category;
        $thumbnail = $request->thumbnail;
        $description = $request->description;

        $discount = Discount::find($discountid);

        if($thumbnail){
            $thumbnailName = rand(1,99999).'_'.$thumbnail->getClientOriginalName();
            $thumbnail->move('Images',$thumbnailName);
        }
        else{
            $thumbnailName = $request->old_thumbnail;
        }

        $sale_price = $regular_price-($regular_price*$discount->name/100);

        try{
            $product = new Product();
            $product = $product->find($id);
            $product->update([
                'name'=>$name,
                'qty'=>$qty,
                'thumbnail'=>$thumbnailName,
                'description'=>$description,
                'userId'=>Auth::user()->id,
                'categoryId'=>$category,
                'discountId'=>$discountid,
                'viewer'=>0,
                'salePrice'=>$sale_price,
                'regularPrice'=>$regular_price
            ]);
            $product->sizes()->sync($size);
            $product->colors()->sync($color);
            return redirect()->route('openUpdateProduct',$id)->with('success','Product updated successfully...!');
        }
        catch(Exception $e){
            return redirect()->route('openUpdateProduct',$id)->with('error','Product can not update please try again');
        }

    }
    public function delete(Request $request){
        $id = $request->remove_id;
        $product = Product::find($id);
        $product->sizes()->detach();
        $product->colors()->detach();
        $product->delete();
        return redirect()->route('viewProduct')->with('success','Product deleted successfully...!');
    }

    public function search(Request $request){
        $query    = $request->input('query');
        // return $query;
        $products = Product::with('colors','sizes')
                    ->select('products.*','users.name as Username','categories.name as CateName','discounts.name as DiscountName')
                    ->join('users','products.userId','=','users.id')
                    ->join('categories','products.categoryId','=','categories.id')
                    ->join('discounts','products.discountID','=','discounts.id')
                    ->where('products.name','LIKE','%'.$query.'%')
                    ->orderBy('products.id','desc')
                    ->get();

        return view('Backend.Product.search-product',compact('products'));
    }
}
