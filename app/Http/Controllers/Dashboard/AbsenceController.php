<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Parente;
use App\Models\Student;
use App\Models\Classroom;
use App\Models\Level;




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


}
