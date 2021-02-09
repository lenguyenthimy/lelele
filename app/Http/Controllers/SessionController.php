<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\User;

class SessionController extends Controller
{
    public function create(){
        return view('signin_form');
    }

    public function store(Request $request)
    {
        $this->validate($request, 
            [
                'email' => 'required|string|email|max:191',
                'password' => 'required|string|min:6',
            ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // return redirect()->intended('/');
            $user = User::where('email', $request['email'])->first();
            if (isset($user)) {
                if ($user->activation) {
                    return redirect()->intended('/');
                }
                return back()->with('error', 'You need to activate your acount. Check your email to activate!');
            }
            return back()->with('error', 'Oppes! You have entered invalid credentials');
        }

        return back()->with('error', 'Oppes! You have entered invalid credentials');
    }
    public function logout()
    {
        Auth::logout();
        return view('signin_form');
    }
}
