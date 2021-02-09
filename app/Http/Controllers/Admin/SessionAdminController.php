<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SessionAdminController extends Controller
{
    public function new(){
        return view('signin');
    }
    public function create(){

    }
    public function destroy(){
        
    }
}
