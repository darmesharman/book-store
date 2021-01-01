<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use AuthenticatesUsers;

class LoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest')->except('logout');
    }

    public function loginForm(){
        return view('auth.login');
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('books.index');
        }
        else {
            return redirect()->route('loginform');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('books.index');
    }

    protected function authenticated(Request $request, $user)
    {
        // to admin dashboard
        if($user->isAdmin()) {
            return redirect()->route('admin.index_book_admin');
        }

        // to user dashboard
        else if($user->isUser()) {
            return redirect()->route('user.index_user');
        }

        abort(404);
    }
}
