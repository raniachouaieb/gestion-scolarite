<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Level;
use App\Models\Module;
use App\Models\Note;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;


class NoteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index(Request $request)
    {
        $level = Level::orderBy('created_at', 'asc')->get();


        return view('dashboard.notes.index',compact('level'))->withTitle(__('Scores'))->withName(__('Scores'));
    }

    public function loadModules( $classroom_id = null,$level_id = null)
    {
      //  dd($level_id);
        // Grab all the classes
        $modules = Module::with('matieres')->where('niveau_id', '=',$level_id )->get();
//dd($level_id);
        return view("dashboard.notes.loadModule", [
            'modules' => $modules,
            'level_id' => $level_id,
            'classroom_id' => $classroom_id,
        ])->render();
    }

    public function loadNotes($classroom_id = null, $level_id = null, $trimestre = null, $lesson_id = null)
    {
        $students = Student::where("niveau", "=", $level_id)->where("classe", "=", $classroom_id)->get();

        return view("dashboard.notes.loadNotes", [
            'level_id' => $level_id,
            'classroom_id' => $classroom_id,
            'students' => $students,
            'lesson_id' => $lesson_id,
            'trimestre' => $trimestre,

        ])->render();
    }

    public function store(Request $request)
    {

      //  $this->checkPermission('ecole_note_update');
       // dd($request->get("student"));
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

        foreach ($request->get("student") as $student) {
            if ($student["note_id"] != -1) {
                $data = Note::find($student["note_id"]);
            } else {
                $data = new Note();
            }
           // dd($request);
            $data->trimestre = $trimestre;
            $data->student_id = $student['student_id'];
            $data->note = $student['note'];
            $data->matiere_id = $lesson_id;
            $data->save();
        }

        $arr = array('msg' => 'Successfully Form Submit', 'status' => true);
        return response()->json($arr);

    }
}
