<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index(){
        return view('auth.login');
    }

    public function store(Request $request){

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->remember == "on" ? true : false;

        if(!auth()->attempt($request->only('username', 'email', 'password'), $remember)){
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
