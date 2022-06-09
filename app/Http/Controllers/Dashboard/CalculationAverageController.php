<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Bulletin;
use App\Models\Classroom;
use App\Models\Level;
use App\Models\Module;
use App\Models\moduleMoyenne;
use App\Models\Student;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CalculationAverageController extends Controller

{
    public function index(Request $request)
    {
       $levels = Level::all();
        $classe = [];
        $builletins=session()->get( 'builletins' );

        return view('dashboard.calculMoyenne.index', compact('levels','classe','builletins'))->withTitle(__('Calculation Average'))->withName(__('Calculation of Average'));
    }



    public function gradebook(Request $request)
    {
      //  $this->checkPermission('ecole_bulletin_view');
       $modules=Module::get();
        $builletins  = Bulletin::get();
        $breadcrumbs = [
            [
                'url' => route('bulletin.admin.index')
            ],
            [
                'class' => 'active'
            ],
        ];
        return view('calculationAverage.gradebook', compact('breadcrumbs','builletins','modules'))->withTitle(__('Gradebook'))->withName(__('Gradebook'))->withNameBreadcrumbs( __("All"));
    }
    public function store(Request $request)
    {

        $level_id = $request->get('niveau');
        $classroom_id = $request->get('classe');
        $trimester= $request->get('trimester');

        $students= Student::where('class_id',$classroom_id)->get();
        $modules=Module::where('niveau_id','=',$level_id)->get();
        $builletins=array();
      //  dd($classroom_id,$level_id,$students);
        foreach($students as $student){
           // dd($student);
            $builletin=array();
            $builletin["student_id"]=$student->id;
            $builletin["student"]=$student->nomEleve.' '.$student->prenomEleve;
            $builletin["modules"]=array();

            $coeffSum=0;$moyenneSum=0;
            $basicmoyenneSum=0;
            $basiccoeffSum=1;
            foreach($modules as $module){
                $output=array();
                $output["module"]=$module->nom_module;
                $output["moduleCoeff"]=$module->coefficient_module;
                $sum=0;
                $matierTab=array();
                foreach($module->matieres as $matiere){
                    $note = $student->notes->where('trimestre','=',$trimester)->where('matiere_id','=',$matiere->id)->first();
                    if(isset($note))
                        $sum=$sum+$note->note;
                }

               $count=count($module->matieres);

                    $moyenne =($sum/$count);

                $moyenneSum=$moyenneSum+($moyenne*$module->coefficient_module);

                $coeffSum=$coeffSum+$module->coefficient_module;


                if($module->basicStudy==true){

                    $basicmoyenneSum=$moyenneSum+($moyenne*$module->coefficient_module);
                    $basiccoeffSum=($basiccoeffSum+$module->coefficient_module);

                }
//dd($moyenne);
                $output["moyenne"]=$moyenne;
                $moduleMoyenne = moduleMoyenne::where('student_id','=',$student->id)->where('module_id','=',$module->id)->where('trimestre','=',$trimester)->first();
                if(!isset($moduleMoyenne)){
                    moduleMoyenne::create([
                        'trimestre'=>$trimester,
                        'module_id'=>$module->id,
                        'student_id'=>$student->id,
                        'moyenne'=>$moyenne,
                        'remarque_note_id'=>1
                        ,
                    ]);
                }else{
                    $moduleMoyenne->moyenne=$moyenne;
                    $moduleMoyenne->save();
                }

                array_push($builletin["modules"],$output);

            }
         //   dd($moyenneSum,$coeffSum,$moyenne);
            //$moyenneSum not working
            $builletin["moyenne"]=$moyenneSum/$coeffSum;
            $builletin["basicmoyenne"]=$basicmoyenneSum/$basiccoeffSum;
                //$basiccoeffSum;

            $bulletin = Bulletin::where('student_id','=',$student->id)->where('trimestre','=',$trimester)->first();
         //  dd($bulletin);
            if(!isset($bulletin)){
                Bulletin::create([
                    'trimestre'=>$trimester,
                    'student_id'=>$student->id,
                    'status'=>'0',
                    'path'=>'',
                    'moyenne'=>$builletin["moyenne"],
                    'basicmoyenne'=>$builletin["basicmoyenne"]
                    ,
                ]);
            }else{
                $bulletin->moyenne=$builletin["moyenne"];
                $bulletin->basicmoyenne=$builletin["basicmoyenne"];
                $bulletin->save();
            }
            array_push($builletins,$builletin);
        }
        return Redirect::route('calculMoyenne.admin.index')->with( ['builletins' => $builletins] );

    }



}

