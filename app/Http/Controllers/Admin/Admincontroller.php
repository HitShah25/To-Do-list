<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Todo;
use App\Models\User;

class Admincontroller extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }
    public function show()
    {
        $todos = Todo::get();
        $adminId = Auth::id();
        return view('admin.showuser', ['todos' => $todos, 'adminId' => $adminId]);
    
    }
    public function user_show()
    {
        $user=User::get();
        return view('admin.show',['user'=>$user]);
    }
    public function login(Request $request)
    {   
        
        if(Auth::attempt($request->only('email','password')))
        {
            if(auth()->user()->is_admin)
            {
            return view('admin.dashboard');
            }
            Auth::logout();   
        }
        return back()->withErrors(['email'=>'Wrong crediantials']);

    }
}
