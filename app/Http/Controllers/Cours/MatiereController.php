<?php

namespace App\Http\Controllers\Cours;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class MatiereController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
      $this->middleware('auth');
  }
    public function index()
    {
        $title = "Matières";
        $list = \App\Matiere::get();
        return view('cours.matiere.index', compact('title','list'));
    }

    public function create()
    {
      $title = "Ajout Matière";
      return view('cours.matiere.add',compact('title'));
    }

    public function store(Request $request)
    {
      //$title = "Matière ajoutée";
      $name = \Input::get('name');
      $matiere = \App\Matiere::firstOrCreate(['name'=> $name]);
      Session::flash('flash_message', "La matière a bien été ajouté !");
      return redirect(route('matieres.index'));
    }

    public function show($id)
    {
      $matiere = \App\Matiere::findOrFail($id);
      $title=$matiere->name;
      return view('cours.matiere.matiere', compact('title','matiere'));
    }

    public function destroy($id){
      $matiere = \App\Matiere::findOrFail($id);
      //dd($matiere);
      if($matiere->delete()){
        Session::flash('flash_message', "La matière a bien été supprimé!");
        return redirect(route('matieres.index'));
      }
      else{
        Session::flash('flash_error', "ERREUR : La matière n'a pas pu être supprimé!");
        return redirect(route('matieres.index'));
      }
    }
}
