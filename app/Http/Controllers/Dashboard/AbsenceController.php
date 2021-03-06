<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Absence;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Parente;
use App\Models\Student;
use App\Models\Classroom;
use App\Models\Level;
use Illuminate\Support\Facades\Session;


class AbsenceController extends Controller
{
    public function __construct(){
        $this -> middleware('auth:admin');
    }

    public function index(){
        $niveaux = Level::orderBy('created_at', 'ASC')->get();

        return view('dashboard.absence.list-eleve-class',compact(  'niveaux'))->withTitle('Liste des eleves acceptée');

    }


    public function eleveByClass(Request $req)
    {
        $niveaux = Level::orderBy('created_at', 'ASC')->get();
        $class = Classroom::get();


        $eleveByClass = Student::where('class_id', '=', $req->class)->get();

        return view('dashboard.absence.index',compact('eleveByClass', 'niveaux', 'class'));
    }

    public function getClasse(Request $request){
        $html=[];
        $classe = Classroom::where('id_level', $request->get('niveau'))->get();
        foreach($classe as $class){
            $html[$class->id]=$class->name;
        }
        return $html;
    }

    public function store(Request $request){
        try{
            $dateAbs= date('Y-m-d');
//dd($request->etat);
          foreach ($request->etat as $studentId=> $etatabs) {
                $etat=1;
                if($etatabs == 1){
                    $etat = 1;
                }elseif($etatabs == 0){
                    $etat = 0;
                }

                $abs = new Absence();
                $abs->eleve_id = $studentId;
                $abs->date_absence = $dateAbs;
                  $abs->etat = $etat;

                $abs->save();
            }

                Session::flash('statuscode', 'success');
                return redirect()->route('absence.index')->with('status', 'Convocation est envoyée avec succes');

        }catch(\Exception $ex){
            return $ex;
            Session::flash('statuscode', 'success');
            return redirect()->route('absence.index')->with('error', 'error');


        }
}


}
