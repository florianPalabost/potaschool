<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PotagersController extends Controller
{
    // index : map du potager
    public function index(){
        $user = session('user');
        /*     
        $infos = \App\AvancementEleve::select('*')->join('classes','avancement_eleves.idClasse','=','classes.id')
                                        ->join('cours','avancement_eleves.idCours','=','cours.id')
                                        ->join('modules','cours.module_id','=','modules.id')
                                        ->join('matieres','modules.matiere_id','=','matieres.id')
                                        ->where('avancement_eleves.idEleve',$user['id'])->get();
        */
      // dd($infos);
       
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
        ->where('avancement_eleves.idEleve',$user['id'])->distinct()->get();
        //dd($cours);
        return view('potager.index',compact('user','matieres','cours','modules'));
    }
}
