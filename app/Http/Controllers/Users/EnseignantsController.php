<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Classe;

class EnseignantsController extends Controller
{
    public function showDashboard(){
        //dd(session('user'));
        $user = session('user');
        $classes = Classe::select('*')->where('responsable',$user['nom'])->get();
        //dd($classes);
        session(['classesEnseignant' => $classes]);
        return view('users/dashboard');
    }
}
