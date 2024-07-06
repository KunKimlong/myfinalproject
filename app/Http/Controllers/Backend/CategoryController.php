<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::get();
        return view('Backend.Category.view-category',compact('categories'));
    }
    public function openAdd(){
        return view('Backend.Category.add-category');
    }
    public function create(Request $request){
        // return 123;
        try {
            Category::Create([
                'name'=>$request->name
            ]);
            return redirect()->route('addCategory')->with('success','Category Create Sucessfuly');
        } catch (Exception $e) {
            return redirect()->route('addCategory')->with('error','Please enter name of  Category');
        }
    }
    public function openUpdate($id){
        $category = Category::find($id);
        return view('Backend.Category.update-category',compact('category'));
    }
    public function update(Request $request){
        $id = $request->id;
        $name = $request->name;
        try{
            Category::where('id',$id)->update([
                'name'=>$name
            ]);
            return redirect()->route('openUpdateCategory',$id)->with('success','Category is updated successfuly');
        }catch(Exception $e){
            return redirect()->route('openUpdateCategory',$id)->with('error','please enter name of Category');
        }
    }
    public function delete(Request $request){
        $id = $request->remove_id;
        Category::where('id',$id)->delete();
        return redirect()->route('viewCategory',$id)->with('success','Category is updated successfuly');   
    }
}
