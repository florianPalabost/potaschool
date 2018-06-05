<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;

class PotagersController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    // index : map du potager
    public function index(){
        $user = session('user');       
      // ya surement des infos inutiles mais osef
       $modules = \App\AvancementEleve::select('modules.*')->join('cours','avancement_eleves.idCours','=','cours.id')
       ->join('modules','cours.module_id','=','modules.id')
       ->where('avancement_eleves.idEleve',$user['id'])->distinct()->get();
       //dd($modules);

        $matieres =\App\AvancementEleve::select('matieres.*')->join('cours','avancement_eleves.idCours','=','cours.id')
        ->join('modules','cours.module_id','=','modules.id')
        ->join('matieres','modules.matiere_id','=','matieres.id')
        ->where('avancement_eleves.idEleve',$user['id'])->distinct()->get();
        //dd($matieres);
        $cours =\App\AvancementEleve::select('cours.*')->join('cours','avancement_eleves.idCours','=','cours.id')
        ->join('modules','cours.module_id','=','modules.id')
        ->join('matieres','modules.matiere_id','=','matieres.id')
        ->where('avancement_eleves.idEleve',$user['id'])->distinct();
        $choixCours = $cours->pluck('name','id');
        $cours = $cours->get();
        $lesMatieres = \App\Matiere::select('*')->pluck('name','id');
        //dd($lesMatieres);
        //dd($choixCours);
        $classes = \App\ElAppClas::join('classes','el_app_clas.idClasse','=','classes.id')->where('idEleve',$user['id'])->get();
        //dd($classes);
        return view('potager.index',compact('user','matieres','lesMatieres','cours','choixCours','modules','classes'));
    }

    public function findModule() {
          //recherche par id module
          $query = "select `id`, `nomModule` from `modules` where `matiere_id` like ? LIMIT 10 ";
          $search = '%'.$_GET['idMatiere'].'%';
          //  dd($search);
          $results = DB::select($query , array($search));
          //dd($results);
          return $results;
    }
    public function findCours() {
          //recherche par id module
          $query = "select `id`, `name` from `cours` where `module_id` like ? LIMIT 10 ";
          $search = '%'.$_GET['idModule'].'%';
          //  dd($search);
          $results = DB::select($query , array($search));
          //dd($results);
          return $results;
    }

    public function storeGraine(Request $request){
        dd($request->all());
        //$scoreActuel=;
        //$scoreMax=;
       /* if(\App\ElAppClas::create([
            'idEleve' => $request->get('nom'),
            'idClasse' => $request->get('statut'),
            'idCours' => $request->get('niveau'),
            'scoreAct' => $request->get('responsable'),
            'scoreMax' => $request->get('responsable')
        ])){*/
    }

}
