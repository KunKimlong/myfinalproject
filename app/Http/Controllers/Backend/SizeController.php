<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SizeController extends Controller
{
    public function index(){
        $sizes = Size::get();
        return view('Backend.Size.view-size',compact('sizes'));
    }
    public function openAdd(){
        return view('Backend.Size.add-size');
    }
    public function create(Request $request){
        
        try {
            Size::Create([
                'name'=>$request->name
            ]);
            return redirect()->route('addSize')->with('success','Size Create Sucessfuly');
        } catch (Exception $e) {
            return redirect()->route('addSize')->with('error','Please enter name of  Size');
        }
    }
    public function openUpdate($id){
        $size = Size::find($id);
        return view('Backend.Size.update-size',compact('size'));
    }
    public function update(Request $request){
        $id = $request->id;
        $name = $request->name;
        try{
            Size::where('id',$id)->update([
                'name'=>$name
            ]);
            return redirect()->route('openUpdateSize',$id)->with('success','Size is updated successfuly');
        }catch(Exception $e){
            return redirect()->route('openUpdateSize',$id)->with('error','please enter name of Size');
        }
    }
    public function delete(Request $request){
        $id = $request->remove_id;
        Size::where('id',$id)->delete();
        return redirect()->route('viewSize',$id)->with('success','Size is updated successfuly');   
    }
}
