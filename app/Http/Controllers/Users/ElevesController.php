<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ElevesController extends Controller
{
    // route : /profil
    public function getProfil(Request $request){
        $user = $request->user()->getAttributes();

        return view('users/monprofil',compact('user'));
    }

    //route : /testDepart
    public function showTestDepart(Request $request){
        //Voir si on met l'id ou non
       // $eleve = Eleve::findOrFail($eleve);
       // dd($request->user()->getAttributes());
        $eleve = $request->user()->getAttributes();
        return view('users/testDepart',compact('eleve'));
    }

    //route: POST /testDepart
    public function storeTestDepart(Request $request){
        // gerer ce qu'on fait des données en bdd
        dd([$request->math,$request->francais,$request->anglais,$request->qlm]);
    }
}
