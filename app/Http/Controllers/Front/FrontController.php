<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    // page d'accueil du site 
    public function index(){
        return view('front/index');
    }

    public function contact(){
        return view('front/contact');
    }

    public function aPropos(){
        return view('front/aPropos');
    }
}
