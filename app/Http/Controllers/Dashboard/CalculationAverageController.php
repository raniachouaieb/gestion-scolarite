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
        $trimestre = $request->get('trimester');
        $students = Student::where('class_id', '=', $classroom_id)->get();
        $modules = Module::where('niveau_id', '=', $level_id)->get();
        $builletins = array();

        if (count($students) == 0) {

            return Redirect::back()->with('error', "Cette classe n'a pas encore des élèves , Vérifier s'il vous plait!");
        }
        $tabofMoyennes = array();
        foreach ($students as $student) {
            $builletin = array();
            $builletin["student_id"] = $student->id;
            $builletin["student"] = $student->nomEleve . ' ' . $student->prenomEleve;
            $builletin["modules"] = array();
            $moyenneSum = 0;
            $coeffSum = 0;
            $basicmoyenneSum = 0;
            $basiccoeffSum = 0;

            if (count($modules) == 0) {

                return Redirect::back()->with('error', "Ce niveau n'a pas encore des modules, Vérifier s'il vous plait!");
            }

            foreach ($modules as $module) {

                $output = array();
                $output["module"] = $module->nom_module;
                $output["moduleCoeff"] = $module->coefficient_module;
                $sum = 0;

                if (count($module->matieres) == 0) {

                    return Redirect::back()->with('error', "Il existe des modules n'ayant pas des matières!");
                }
                foreach ($module->matieres as $matiere) {
                    $note = $student->notes->where('trimestre', '=', $trimestre)->where('matiere_id', '=', $matiere->id)->first();
                    if (isset($note))
                        $sum = $sum + $note->note;
                }
                $moyenne = ($sum / count($module->matieres));
                $moyenneSum = $moyenneSum + ($moyenne * $module->coefficient_module);
                $coeffSum = $coeffSum + $module->coefficient_module;
                if ($module->basicStudy == true) {
                    $basicmoyenneSum = $basicmoyenneSum + ($moyenne * $module->coefficient_module);
                    $basiccoeffSum = $basiccoeffSum + $module->coefficient_module;
                }

                $output["moyenne"] = $moyenne;
                $moduleMoyenne = moduleMoyenne::where('student_id', '=', $student->id)->where('module_id', '=', $module->id)->where('trimestre', '=', $trimestre)->first();
                if (!isset($moduleMoyenne)) {
                    moduleMoyenne::create([
                        'trimestre' => $trimestre,
                        'module_id' => $module->id,
                        'student_id' => $student->id,
                        'moyenne' => $moyenne,
                        'remarque_note_id' => 1
                        ,
                    ]);
                } else {
                    $moduleMoyenne->moyenne = $moyenne;
                    $moduleMoyenne->save();
                }

                array_push($builletin["modules"], $output);
            }
           // dd($basicmoyenneSum );
            $builletin["moyenne"] = $moyenneSum / $coeffSum;
                $builletin["basicmoyenne"] = $basicmoyenneSum / $basiccoeffSum;



            $bulletin = Bulletin::where('student_id', '=', $student->id)->where('trimestre', '=', $trimestre)->first();
            if (!isset($bulletin)) {
                Bulletin::create([
                    'trimestre' => $trimestre,
                    'student_id' => $student->id,
                    'status' => '0',
                    'path' => '',
                    'moyenne' => $builletin["moyenne"],
                    'basicmoyenne' => $builletin["basicmoyenne"]
                    ,
                ]);
            } else {
                $bulletin->moyenne = $builletin["moyenne"];
                $bulletin->basicmoyenne = $builletin["basicmoyenne"];
                $bulletin->save();
            }
            array_push($builletins, $builletin);
        }
        return Redirect::route('calculMoyenne.admin.index')->with( ['builletins' => $builletins] );

    }



}

