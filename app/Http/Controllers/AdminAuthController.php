<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;




use Hash;
use Session;
use Auth;


class AdminAuthController extends Controller
{
    public function login(){
       return view("auth.login");
    }

    public function register(){
       return view("auth.register");
    }

    public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
}

    public function registerUser(Request $request){
       // echo '<pre>';print_r($request->all());exit;
       //echo"sachin";
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'confirm_password'=>'required'
            
        ]);
        $this->validate($request, [
          'password' => 'min:6',
          'confirm_password' => 'required_with:password|same:password|min:6'
      ]);
      
        $user= new User();
        $user->name =$request->name;
        $user->email =$request->email;
        $user->password =$request->password;
        $user->confirm_password =$request->confirm_password;
        $res=$user->save();
        if($res)
        {
           return back()->with('success','You have registered successfully');
        }
        else
        {
           return back()->with('fail','Something Wrong');
        }

        
        
    }
    public function authenticate(Request $request)
    {
       
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('admin');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);

        
    }
    
}
