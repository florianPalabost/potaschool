<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classe;
use Illuminate\Support\Facades\Session;
use \Illuminate\Support\Facades\DB;

class ClassesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    // return all classes of one teacher
    public function index(Request $request){
       // on recup l'user de la session
        $user = session('user');
        //$classes = Classe:findOrFail()
        //dd($user['nom']);
        $classes = Classe::select('nom','id')->where('responsable',$user['nom'])->get();
        //dd($classes);
        return view('classes.index',compact('user','classes'));
    }

    // return view form to create a class
    public function create(){
        $user = session('user');
        //dd($user);
        return view('classes.create',compact('user'));
    }
    
    // verify infos & store in database
    public function store(Request $request){
        //dd($request->get('niveau'));

        if(Classe::create([
            'nom' => $request->get('nom'),
            'statut' => $request->get('statut'),
            'niveau' => $request->get('niveau'),
            'responsable' => $request->get('responsable')
        ])){
            
            Session::flash('flash_message', 'La nouvelle classe a bien été ajouté !');
            return redirect(route('dashboard'));
        }
        else{
            Session::flash('flash_error', "Il manque des informations !");
            return redirect(route('classes.create'))->withInput();
        }


    }

    public function show($idClasse){
        //dd($idClasse);
        $classe = Classe::findOrFail($idClasse);
        session(['classe' => $classe]);
 
        //recherche des eleves qui appartiennent a la classe
        $eleves = DB::table('el_app_clas')
                    ->join('users','el_app_clas.idEleve','=','users.id')
                    ->where('el_app_clas.idClasse','=',$idClasse)->get();
        //dd($eleves);
        $matieres =\App\Matiere::select('matieres.*')->distinct()->get();
        //count($eleves);
        foreach($eleves as $eleve){
            $avancementExos = \App\AvancementExercice::where('idEleve',$eleve->idEleve)
            ->join('exercices','avancement_exercices.idEx','=','exercices.id')->get();
            //dd($avancementExos);

            $scoresMatiere = DB::select("
            SELECT count(mat.name), mat.name, SUM(a.scoreActuel), ROUND(SUM(a.scoreActuel)/count(mat.name)) as scoreMatiere FROM `avancement_eleves` a 
            JOIN cours c on a.idCours=c.id 
            JOIN modules m on c.module_id = m.id 
            JOIN matieres mat on m.matiere_id = mat.id 
            WHERE a.idEleve = ".$eleve->idEleve." GROUP BY mat.name");
           // dd($scoresMatiere);
            foreach($matieres as $mat){
               // dd($mat->name);
                foreach($scoresMatiere as $score){
                    if(strcmp($mat->name,$score->name)==0){
                        $mat->score = $score->scoreMatiere;
                    }
                }
            }
            $eleve->matieres = $scoresMatiere;
           // dd($eleve->matieres);
        }

        return view('classes.show',compact('classe','eleves','matieres'));
    }
}
