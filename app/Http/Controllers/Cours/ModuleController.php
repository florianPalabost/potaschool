<?php

namespace App\Http\Controllers\Cours;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $title = "Modules";
      $modules = \App\Module::with('matiere')->get();
      return view('cours.module.index', compact('title','modules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $module= new \App\Module();
      $matieres=\App\Matiere::pluck('name','id');
      return view('cours.module.create',compact('module','matieres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $module = \App\Module::create($request->all());
      return redirect(route('module.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $module = \App\Module::findOrFail($id);
      $title = $module->name;
      $matieres=\App\Matiere::pluck('name','id');
      return view('cours.module.show',compact('module','matieres','title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $module = \App\Module::findOrFail($id);
        $matieres=\App\Matiere::pluck('name','id');
        return view('cours.module.edit',compact('module','matieres'));
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
        $module = \App\Module::findOrFail($id);
        $module->update($request->all());
        return redirect(route('module.edit',$id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $module = \App\Module::findOrFail($id);
      //dd($matiere);
      if($module->delete()){
        Session::flash('flash_message', "La module a bien été supprimé!");
        return redirect(route('module.index'));
      }
      else{
        Session::flash('flash_error', "ERREUR : La module n'a pas pu être supprimé!");
        return redirect(route('module.index'));
      }
    }
}
