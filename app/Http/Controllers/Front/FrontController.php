<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    // page d'accueil du site 
    public function index(){
        if(session('user')!= null){
            $user = session('user');
            return view('front/index',compact('user'));
        }
        else{
            return view('front/index');
        }
    }

    public function contact(){
        return view('front/contact');
    }

    public function wiki(){
        return view('front/wiki');
    }
}
