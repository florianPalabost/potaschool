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
        $cours =\App\AvancementEleve::selectRaw('cours.*,avancement_eleves.*')->join('cours','avancement_eleves.idCours','=','cours.id')
        ->join('modules','cours.module_id','=','modules.id')
        ->join('matieres','modules.matiere_id','=','matieres.id')
        ->where('avancement_eleves.idEleve',$user['id'])->distinct();
        $choixCours = $cours->pluck('name','id');
        $cours = $cours->get();
        $lesMatieres = \App\Matiere::select('*')->pluck('name','id');
        //dd($lesMatieres);
       // dd($cours);
        $classes = \App\ElAppClas::join('classes','el_app_clas.idClasse','=','classes.id')->where('idEleve',$user['id'])->get();
        //dd($classes);
        $scoresMatiere = DB::select("SELECT count(mat.name), mat.name, SUM(a.scoreActuel), ROUND(SUM(a.scoreActuel)/count(mat.name)) as scoreMatiere FROM `avancement_eleves` a 
        JOIN cours c on a.idCours=c.id 
        JOIN modules m on c.module_id = m.id 
        JOIN matieres mat on m.matiere_id = mat.id 
        WHERE a.idEleve = ".$user['id']." GROUP BY mat.name");
        //dd($scoresMatiere);
        foreach($matieres as $mat){
           // dd($mat->name);
            foreach($scoresMatiere as $score){
                if(strcmp($mat->name,$score->name)==0){
                    $mat->score = $score->scoreMatiere;
                }
            }
        }
    
        //dd($matieres);

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
    public function findExercices() {
        //dd($results);
        $exercices = \App\Cours::where('cours.name',$_GET['nomCours'])
        ->join('exercices','cours.id','=','exercices.idCours')
        ->get();
        //dd($exercices);
        return $exercices;
    }
    public function findExo() {
        $exercice = \App\Exercice::where('titre',$_GET['titre'])
        ->join('reponses','exercices.id','=','reponses.idExo')
        ->first();
        return $exercice;
    }

    public function storeGraine(Request $request){
        //dd($request->all());
        $appreciations = \App\TestDepart::where([['idEleve',$request->get('idEleve')],['idMatiere',$request->get('idMatiere')]])->get();
       // dd($appreciations[0]['appreciation']);
       $scores = \App\Classe::where('classes.id',$request->get('idClasse'))
       ->join('corresp_niv_scores','classes.niveau','corresp_niv_scores.niv')->get();
       
       if($appreciations->count() > 0){
            if(strcmp($appreciations[0]['aime'],'yes')==0){
                $scoreActuel=2*$appreciations[0]['appreciation']+10+$scores[0]['scoreMin'];
            }
            else{
                $scoreActuel=2*$appreciations[0]['appreciation']+$scores[0]['scoreMin'];
            }
       }
       else{
           $scoreActuel = $scores[0]['scoreMin'];
       }
       
      //  dd($scores[0]['scoreMax']);
       

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

    public function storeRep(Request $request){
        // dd($request->all());
        $avancementExo =  \App\AvancementExercice::where([['idEleve',$request->get('idEleve')],['idEx',$request->get('idExo')]])->get();
       // dd($avancementExo);
        // peut etre nerf le scoreAct
       $scoreAct = 100 - ($request->get('nbErreur')*25);
        if($avancementExo->count() == 0){
            // l'eleve n'avait jamais fait l'exo
            //dd($request->get('idExo'));

            
           // dd($scoreAct);
            \App\AvancementExercice::create([
                'idEleve' => $request->get('idEleve'),
                'idEx' => $request->get('idExo'),
                'scoreAct' =>$scoreAct,
                'meilleurScore' => $scoreAct,
                'nbErreur' => $request->get('nbErreur')
            ]);
            $idCours = \App\Exercice::select('idCours')->where('id',$request->get('idExo'))->get();
            $idClasse = \App\ElAppClas::select('idClasse')->where('idEleve',$request->get('idEleve'))->first();
            //dd($idClasse['idClasse']);
            \App\AvancementEleve::where([['idEleve',$request->get('idEleve')],['idCours',$idCours[0]['idCours']],['idClasse',$idClasse['idClasse']]])
            ->update(['scoreActuel' => $scoreAct]);
            Session::flash('flash_message', "Bravo la plante a bien été arrosée grâce à toi, je constate que tu n'avais jamais fait cet exercice avant !"); 
            return redirect(route('indexPotager'));
        }
        else{
            // l'eleve a au moins deja fait l'exo une fois
           // dd('deja fait cet exo ?');
          // dd($avancementExo[0]['scoreAct']);
            if($scoreAct > $avancementExo[0]['scoreAct']){
                // l'eleve a fait un meilleur score sur l'exo, update avancement exo/eleve
                \App\AvancementExercice::where([['idEleve',$request->get('idEleve')],['idEx',$request->get('idExo')]])
                ->update([
                    'scoreAct' => $scoreAct,
                    'meilleurScore' => $scoreAct
                ]);
                $idCours = \App\Exercice::select('idCours')->where('id',$request->get('idExo'))->get();
                $idClasse = \App\ElAppClas::select('idClasse')->where('idEleve',$request->get('idEleve'))->first();
                //dd($idCours[0]['idCours']);
                \App\AvancementEleve::where([['idEleve',$request->get('idEleve')],['idCours',$idCours[0]['idCours']],['idClasse',$idClasse['idClasse']]])
                ->update([
                    'scoreActuel' => $scoreAct,
                    'scoreMax' => $scoreAct
                ]);
                Session::flash('flash_message', "Bravo, tu as réalisé un meilleur score que la dernière fois et la plante a bien été arrosé!"); 
                 return redirect(route('indexPotager'));
            }
            else{
                dd('pas mieux');
            }

        }
        //Session::flash('flash_error', "Il manque des informations !");
        //return redirect(route('indexPotager'))->withInput();
    }
}