<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClassesController extends Controller
{
    // return all classes of one teacher
    public function index(Request $request){
       // on recup l'user de la session
        $user = session('user');
        //$classes = Classe:findOrFail()

    }

    // return view form to create a class
    public function create(){
        return view('classes.create');
    }
    
    // verify infos & store in database
    public function store(Request $request){
        dd($request);
    }
}
