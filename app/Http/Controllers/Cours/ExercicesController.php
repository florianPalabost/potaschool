<?php

namespace App\Http\Controllers\Cours;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExercicesController extends Controller
{
    public function store(Request $request) {
        //dd($request->all());
        $exo = \App\Exercice::create([
            'idCours' => $request->get('idCours'),
            'titre' => $request->get('titre'),
            'enonce' => $request->get('enonce')
            ]);
        $id = \App\Exercice::select('id')->where([['idCours', $request->get('idCours')],['titre',$request->get('titre')],['enonce',$request->get('enonce')]])->get();
        //dd($id[0]['id']);   
        \App\Reponse::create([
                'idExo' => $id[0]['id'],
                'typeRep' => $request->get('typeRep'),
                'reponse' => $request->get('reponse'),
                'choix2' => $request->get('choix2'),
                'choix3' => $request->get('choix3'),
                'choix4' => $request->get('choix4'),
            ]);
      return redirect(route('cours.show',$request->get('idCours')));
    }
}
