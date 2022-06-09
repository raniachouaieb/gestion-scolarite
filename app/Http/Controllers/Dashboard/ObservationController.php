<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Module;
use App\Models\Observation;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ObservationController extends Controller
{
    public function index(Request $request)
    {            $levels = Level::orderBy('created_at', 'asc')->get();


        return view('dashboard.observation.index', compact('levels'))->withTitle(__('Observation'))->withName(__('Observation'));
    }

    public function loadModules( $classroom_id = null,$level_id = null)
    {
        // Grab all the classes
        $modules = Module::where('niveau_id', '=', $level_id)->get();
        return view("dashboard.observation.loadModules", [
            'modules' => $modules,
            'level_id' => $level_id,
            'classroom_id' => $classroom_id,
        ])->render();
    }

    public function loadObservation($classroom_id = null, $level_id = null, $trimestre = null, $lesson_id = null)
    {
        $students = Student::where("niveau", "=", $level_id)->where("class_id", "=", $classroom_id)->get();
$observation=Observation::get('obs');
$maxobs=max($observation->toArray());
        return view("dashboard.observation.loadNotes", [
            'level_id' => $level_id,
            'classroom_id' => $classroom_id,
            'students' => $students,
            'lesson_id' => $lesson_id,
            'trimestre' => $trimestre,
            'maxobs'=>$maxobs,

        ])->render();
    }

    public function store(Request $request)
    {


        $check = Validator::make($request->input(), [
            'student' => 'required|array|min:1',
            "student.*" => "required",

        ]);
        if ($check->fails()) {
            $arr = array('msg' => 'Something goes to wrong. Please try again lator', 'status' => false);
            return response()->json($arr);
        }

        $trimestre = $request->get("trimestre");
        $lesson_id = $request->get("lesson_id");
        $obs = Observation::select('obs')->get();
        $tab = [];
        foreach ($obs as $k => $o) {

            array_push($tab, $o['obs']);
        }
        //dd($tab);
        //compteur utiliser pour distinguerles observations
        $value = max(isset($tab)?$tab:1);

        foreach ($request->get("student") as $student) {

            $data = new Observation();
            //}


            $data->trimester = $trimestre;
            $data->student_id = $student['student_id'];
            $data->valeur = $student['observation'];
            $data->lesson_id = $lesson_id;
            $data->obs = $value + 1;
            $data->save();
        }
        return redirect()->back()->with('success' , 'Successfully Form Submit');
        //$arr = array('success' => 'Successfully Form Submit', 'status' => true);
        //return response()->json($arr);

    }

}
