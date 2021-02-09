<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function create(){
        return view('signup_form');
    }

    public function index(Request $request)
    {
        dd($request->all());
    }
    public function store(Request $request)
    {
        // $validated = $request->validate([
        //     'name'=>'required|string|max:255',
        //     'email'=>'required|string|email|max:191|unique:users',
        //     'password'=>'required|string|min:6|confirmed',
        // ]);
        $this->validate($request,
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:191|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required',
            ]
        );

        $token = Str::random(60);

        $data = [
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'activation_token' => $token
        ];

        $user = User::create($data);

        Mail::send('mail', ['user' => $user], function ($message) use ($user) {
            $message->from('bkphonestore@gmail.com', 'bkphonestore');
            $message->to($user['email'], $user['name']);
            $message->subject('Activation for Registation');
        });

        return back() -> with('message', 'We have e-mailed your activation link!');
    }
    public function show($user){
        return view('signup');
    }
    public function edit($user){
        return view('signup');
    }
    public function update(){
        return view('signup');
    }
    public function destroy(){
        return view('signup');
    }
    
}
