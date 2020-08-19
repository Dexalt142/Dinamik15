<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthController extends Controller {

    public function showLoginForm() {
        return view('user.auth.login');
    }
    
    public function login(Request $request) {

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['status' => 200, 'user' => Auth::user(), 'redirect' => route('dashboard')]);
        } else {
            return response()->json(['status' => 401, 'errors' => ['email' => ['Email or password is incorrect']]]);
        }
    }

}
