<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Emploi;
use App\Models\Level;
use App\Models\Matiere;
use App\Models\Seance;
use Illuminate\Http\Request;
use App\Http\Requests\SeanceRequest;
use Illuminate\Support\Facades\Session;


class SeanceController extends Controller
{

    public function __construct(){
        $this -> middleware('auth:admin');
    }

    public function index(){

        $seances = Seance::get();

        return view ('dashboard.seance.index', compact('seances'))->withTitle('Liste des seances');
    }

    public function add(){
        $seances = Seance::get();
        $niveaux = Level::get();

        return view('dashboard.seance.store', compact('seances', 'niveaux'))->withTitle('Ajouter seance');

    }

    public function getEmploi(Request $request){
        $html=[];
       $emplois = Emploi::where('niveau_id', $request->get('niveau'))->get();
        foreach($emplois as $emploi){
            $html[$emploi->id]=$emploi->titre;
        }
        return $html;
    }

    public function getMatiere(Request $request){
        $html=[];
        $matieres = Matiere::where('niveau_id', $request->get('niveau'))->get();
        foreach($matieres as $matiere){
            $html[$matiere->id]=$matiere->nom;
        }
        return $html;
    }

    public function store(SeanceRequest $request)
    {
        try {
            $seances = new Seance();
            $seances->start_time= $request->start_time;
            $seances->end_time= $request->end_time;
            $seances->day= $request->day;
            $seances->emploi_id= $request->emploi;
            $seances->matiere_id=$request->matiere;
            $dataSeance = $seances->save();
            if($dataSeance) {
                Session::flash('statuscode', 'success');
                return redirect()->route('seance.index')->with('status', 'seance est ajouté avec succes');
            }else

                Session::flash('statuscode', 'error');
            return redirect()->route('seance.index')->with('status','seance est error');

        }catch (\Exception $ex){
            return redirect()->route('seance.index')->with(['status'=>'Error']);
        }


    }

    public function edit( $id){
        $matiere = Matiere::get();
        $emplois = Emploi::get();
        $niveaux = Level::get();
        $seances = Seance::find($id);
        if(!$seances){
            Session::flash('statuscode', 'error');

            return redirect()->route('seance.index')->with(['status'=>'there is no data with this id, please enter a correct one']);
        }
        return view('dashboard.seance.edit',compact( 'niveaux', 'seances','emplois', 'matiere'))->withTitle('Edition matiere');
    }

    public function update(Request $request, $id){

        $seanceID = Seance::find($id);
        try{
            if(!$seanceID){
                Session::flash('statuscode', 'error');

                return redirect()->route('convocations.index')->with(['status'=>'there is no data with this id, please enter a correct one']);
            }

            $dataupdatetd = $seanceID->update([
                'start_time'=>$request->start_time,
                'end_time'=> $request->end_time,
                'day'=>$request->day,
                'emploi_id'=>$request->emploi,
                'matiere_id'=>$request->matiere,
                'niveau'=>$request->niveau
                ]);

             //$dataupdatetd =$seanceID->update($request->all());

             if($dataupdatetd &&   $request->all() === 'canceled' ){
                Session::flash('statuscode', 'success');
                return redirect()->route('seance.index')->with(['status'=>'Modification avec succés']);
             }else{
                 Session::flash('statuscode', 'success');
                 return redirect()->route('seance.index')->with(['status'=>'nothing updated']);
             }
        }catch(\Exception $exception){
            return $exception;
            Session::flash('statuscode', 'error');

            return redirect()->route('seance.index')->with(['status'=>'There is an error :(']);
        }


    }

    public function destroy($id){
        $seances = Seance::find($id);
        $seances->delete();
        Session::flash('statuscode', 'error');
        return redirect()->route('seance.index')->with('status','Cette seance est annulée');
    }
}
