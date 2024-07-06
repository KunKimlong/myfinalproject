<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function openRegister(){
        return view('Backend.register');
    }
    public function register(Request $request){
        $profile = $request->profile;

        if($profile){
            $profileName = rand(1,9999).'_'.$profile->getClientOriginalName();
            $profile->move('Images',$profileName);
        }
        try {
            User::create(attributes: [
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'profile'=>$profileName
            ]);
            return redirect()->route('login');

        } catch (Exception $th) {
            return redirect()->route('openRegister')->with('error','please enter correctly...!');
        }
    }
    public function openLogin(){
        return view('Backend.login');
    }
    public function login(Request $request){
        if(Auth::attempt(['email'=>$request->name_email,'password'=>$request->password])){
            return redirect()->route("home");
        }
        else if(Auth::attempt(['name'=>$request->name_email,'password'=>$request->password])){
            return redirect()->route("home");
        }
        else{
            return redirect()->route('login')->with('error','Invalid Username Email or Password');
        }
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
