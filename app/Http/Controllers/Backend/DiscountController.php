<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Discount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiscountController extends Controller
{
    public function index(){
        $discounts = Discount::get();
        return view('Backend.Discount.view-discount',compact('discounts'));
    }
    public function openAdd(){
        return view('Backend.Discount.add-discount');
    }
    public function create(Request $request){
        // return 123;
        try {
            Discount::Create([
                'name'=>$request->name
            ]);
            return redirect()->route('addDiscount')->with('success','Discount Create Sucessfuly');
        } catch (Exception $e) {
            return redirect()->route('addDiscount')->with('error','Please enter name of  Discount');
        }
    }
    public function openUpdate($id){
        $discount = Discount::find($id);
        return view('Backend.Discount.update-discount',compact('discount'));
    }
    public function update(Request $request){
        $id = $request->id;
        $name = $request->name;
        try{
            Discount::where('id',$id)->update([
                'name'=>$name
            ]);
            return redirect()->route('openUpdateDiscount',$id)->with('success','Discount is updated successfuly');
        }catch(Exception $e){
            return redirect()->route('openUpdateDiscount',$id)->with('error','please enter name of Discount');
        }
    }
    public function delete(Request $request){
        $id = $request->remove_id;
        Discount::where('id',$id)->delete();
        return redirect()->route('viewDiscount',$id)->with('success','Discount is updated successfuly');   
    }
}
