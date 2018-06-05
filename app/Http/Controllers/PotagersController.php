<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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

        $matieres =\App\Matiere::select('matieres.*')
       ->distinct()->get();
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
        //dd($request->all());
        $appreciations = \App\TestDepart::where([['idEleve',$request->get('idEleve')],['idMatiere',$request->get('idMatiere')]])->get();
       // dd($appreciations[0]['appreciation']);
        $scores = \App\Classe::where('classes.id',$request->get('idClasse'))
        ->join('corresp_niv_scores','classes.niveau','corresp_niv_scores.niv')->get();
      //  dd($scores[0]['scoreMax']);
        if(strcmp($appreciations[0]['aime'],'yes')==0){
           $scoreActuel=2*$appreciations[0]['appreciation']+10+$scores[0]['scoreMin'];
        }
        else{
            $scoreActuel=2*$appreciations[0]['appreciation']+$scores[0]['scoreMin'];
        }

       \App\AvancementEleve::create([
            'idEleve' => $request->get('idEleve'),
            'idClasse' => $request->get('idClasse'),
            'idCours' => $request->get('idCours'),
            'scoreActuel' => $scoreActuel,
            'scoreMax' => $scores[0]['scoreMax']
        ]);
        Session::flash('flash_message', "Ta graine a bien été planté ^^");
        return redirect(route('indexPotager'));
    }
}