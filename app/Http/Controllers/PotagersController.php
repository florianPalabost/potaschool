<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PotagersController extends Controller
{
    // index : map du potager
    public function index(){
        $user = session('user');
        return view('potager.index',compact('user'));
    }
}
