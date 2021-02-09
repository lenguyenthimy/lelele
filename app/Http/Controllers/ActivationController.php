<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;

class ActivationController extends Controller
{
    public function create(Request $request){
        $user = User::find($request->id)
                    ->update(['activation' => true]);
        return redirect('/signin');
    }
}
