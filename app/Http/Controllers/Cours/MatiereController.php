<?php

namespace App\Http\Controllers\Cours;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MatiereController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getList()
    {
        $title = "Matières";
        $list = \App\Matiere::get();
        return view('cours/matiere', compact('title','list'));
    }

    public function add()
    {
      $title = "Ajout Matière";
      return view('cours/matiere/add',compact('title'));
    }

    public function save()
    {
      $title = "Matière ajoutée";
      $name = \Input::get('name');
      $matiere = \App\Matiere::firstOrCreate(['name'=> $name]);

      return view('cours/matiere/success', compact('title','matiere'));
    }

    public function get($id)
    {
      $matiere = \App\Matiere::findOrFail($id);
      $title=$matiere->name;
      return view('cours/matiere/matiere', compact('title','matiere'));
    }
}
