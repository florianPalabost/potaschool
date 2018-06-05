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
        //count($eleves);

        return view('classes.show',compact('classe','eleves'));
    }
}
