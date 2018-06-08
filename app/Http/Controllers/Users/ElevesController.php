<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ElevesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    // route : /profil
    public function getProfil(Request $request){
        $user = $request->user()->getAttributes();
        return view('users/monprofil',compact('user'));
    }

    //route : /testDepart
    public function showTestDepart(Request $request){
        // Voir si on met l'id ou non
       // $eleve = Eleve::findOrFail($eleve);
       // dd($request->user()->getAttributes());
        $eleve = $request->user()->getAttributes();
        $matieres =\App\Matiere::select('matieres.*')
        ->distinct()->get();
       //dd($matieres);
        return view('users/testDepart',compact('eleve','matieres'));
    }

    //route: POST /testDepart
    public function storeTestDepart(Request $request){
        // gerer ce qu'on fait des données en bdd
        $user = session('user');
        //dd($user['id']);
      //  dd($request->except('_token'));
        foreach($request->except('_token') as $id => $value){
           // echo "My id is ". $id . " And My value is ". $value;

           if(is_int($id)){
            //dd($request->get('like_'.$id));
            \App\TestDepart::create([
                'idEleve' => $user['id'],
                'idMatiere' => $id,
                'appreciation' => $value,
                'aime' => $request->get('like_'.$id)
            ]);
           }   
        }
        Session::flash('flash_message', "Merci d'avoir pris le temps de faire ce test vous pouvez maintenant joué ^^");
        return redirect(route('indexPotager'));
    }

    // liste de tous les eleves 
    public function index(){
        //dd('nothing here');
        $eleves = \App\User::select('*')->where('type','eleve')->get();
        return view('users.listEleves',compact('eleves'));
    }

    public function create(){
        $classe = session('classe');
        return view('users.create',compact('classe'));
    }

    public function rechEleve(){
        //recherche par le nom de famille
        $query = "select `id`, `nom`, `prenom` from `users` where `type`='eleve' and `nom` like ? LIMIT 10 ";
        $search = '%'.$_GET['rech'].'%';
        //  dd($search);
        $results = DB::select($query , array($search));
        //dd($results);
        return $results;
    }
    public function store(Request $request){
        // dd($request->all());
        $idEleves = explode(",",$request->get('listEleves'));
        foreach($idEleves as $idE){
            \App\ElAppClas::create([
                'idEleve' => $idE,
                'idClasse' => $request->get('idClasse')
            ]);
        }
        Session::flash('flash_message', "Le(s) élève(s) ont bien été ajouté à la classe!");
        return redirect(route('classes.show', $request->get('idClasse')));
    }

}
