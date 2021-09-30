<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class registerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index(){
        return view('auth.register');
    }

    public function store(Request $request){
        $this->validate($request,[
            'username'=>'required|unique:users|max:255',
            'email'=>'required|unique:users|email|max:255',
            'password'=>'required|confirmed',
        ]);

        User::create([
            'username'=>$request->username,
            'role'=>'user',
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);

        auth()->attempt($request->only('email', 'password'));
        $request->session()->put('loggedUser',auth()->user()->id);

        return redirect()->route('home');

    }
}
