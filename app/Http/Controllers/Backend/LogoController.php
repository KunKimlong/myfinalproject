<?php

namespace App\Http\Controllers\Backend;

use App\Models\Logo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogoController extends Controller
{
    public function index(){
        $thumbnails = Logo::get();
        // return $thumbnails;
        return view('Backend.Logo.view-logo',compact('thumbnails'));
    }
    public function openAddLogo(){
        return view('Backend.Logo.add-logo');
    }
    public function addLogo(Request $request){
        $thumbnail = $request->thumbnail;

        if($thumbnail){
            $thumbnailName = rand(1,99999).'_'.$thumbnail->getClientOriginalName();
            $thumbnail->move('Images',$thumbnailName);

            Logo::create([
                'thumbnail'=>$thumbnailName
            ]);
            return redirect()->route('openAddLogo')->with('success','Logo Created');
        }   
        else{
            return redirect()->route('openAddLogo')->with('error','Please Choose Logo');
        }

    }
    public function openUpdateLogo($id){
        // $logo = Logo::find($id);
        $logo = Logo::where('id',$id)->first();
        return view('Backend.Logo.update-logo',compact('logo'));
    }
    public function updateLogo(Request $request){
        $id = $request->id;
        $thumbnail = $request->thumbnail;
        if($thumbnail){
            $thumbnailName = rand(1,99999).'_'.$thumbnail->getClientOriginalName();
            $thumbnail->move('Images',$thumbnailName);

            Logo::where('id',$id)->update([
                'thumbnail'=>$thumbnailName
            ]);
            return redirect()->route('openUpdateLogo',$id)->with('success','Logo Updated');
        }   
        else{
            return redirect()->route('openUpdateLogo',$id)->with('error','Please Choose Logo');
        }
    }

    public function deleteLogo(Request $request){
        $id = $request->remove_id;
        Logo::where("id",$id)->delete();
        return redirect()->route('openLogo')->with('success','Logo Deleted successfuly');
    }
}
