<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;

class VueController extends Controller
{
    //
    public function register(){
        if (session()->get('logged_in')){
            return redirect('vue/home');
            // ->route()
        }else{
            return view('auth.register');
        }
    }
    public function save_user(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'confirm_password' => 'required_with:pwd|same:pwd|min:8',
        ]);
    }
}
