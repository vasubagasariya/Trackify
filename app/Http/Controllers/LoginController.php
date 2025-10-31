<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function show(){
        return view('login');
    }
    public function check(Request $req){
        $user = Customer::where('username',$req->username)->first();
        if($user && Hash::check($req->password, $user->password)){
            session(['admin_logged_in' => true, 'user_id' => $user->id]);
            return redirect()->route('dashboard');
        }
        else{
            return redirect()->route('login.show')->with('error','Invalid password');
        }
    }
}
