<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Exception;
use Illuminate\Http\Request;


class ColorController extends Controller
{
    public function index(){
        $colors = Color::get();
        return view('Backend.Color.view-color',compact('colors'));
    }
    public function openAdd(){
        return view('Backend.Color.add-color');
    }
    public function create(Request $request){
        
        $color = new Color();
        try {
            $color->CreateColor($request->name);
            return redirect()->route('addColor')->with('success','Color Create Sucessfuly');
        } catch (Exception $e) {
            return redirect()->route('addColor')->with('error','Please enter name of  color');
        }
    }
    public function openUpdate($id){
        $color = Color::find($id);
        return view('Backend.Color.update-color',compact('color'));
    }
    public function update(Request $request){
        $id = $request->id;
        $name = $request->name;
        try{
            Color::where('id',$id)->update([
                'name'=>$name
            ]);
            return redirect()->route('openUpdateColor',$id)->with('success','Color is updated successfuly');
        }catch(Exception $e){
            return redirect()->route('openUpdateColor',$id)->with('error','please enter name of color');
        }
    }
    public function delete(Request $request){
        $id = $request->remove_id;
        Color::where('id',$id)->delete();
        return redirect()->route('viewColor',$id)->with('success','Color is updated successfuly');   
    }
}
