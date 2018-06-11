<?php

namespace App\Http\Controllers\Cours;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CoursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
      $this->middleware('auth');
     }

    public function index()
    {
      $title = "Cours";
      $cours = \App\Cours::with('module')->get();
    
      return view('cours/cours/index', compact('title','cours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $cours= new \App\Cours();
      $modules=\App\Module::pluck('nomModule','id');
      return view('cours.cours.create',compact('cours','modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $cours = \App\Cours::create($request->all());
      Session::flash('flash_message', "Le cours a bien été ajouté !");
      return redirect(route('cours.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //dd('pas fait show');
        $cours = \App\Cours::findOrFail($id);
        //dd($cours);
        //dd(session('user'));
        //chercher tous les exos qui ont comme idCours celui du $cours
         $exercices = \App\Exercice::where('idCours',$id)->join('reponses','exercices.id','=','reponses.idExo')->get();
// a verif un autre jour jpp
        //dd($exercices);
        return view('cours.cours.show',compact('cours','exercices'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd(' edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cours = \App\Cours::findOrFail($id);
        //dd($matiere);
        if($cours->delete()){
          Session::flash('flash_message', "Le cours a bien été supprimé!");
          return redirect(route('cours.index'));
        }
        else{
          Session::flash('flash_error', "ERREUR : Le cours n'a pas pu être supprimé!");
          return redirect(route('cours.index'));
        }
    }
}
