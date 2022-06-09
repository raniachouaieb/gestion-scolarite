<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\Level;
use App\Models\Module;
use App\Models\moduleMoyenne;
use App\Models\Note;
use App\Models\RemarqueModule;
use App\Models\RemarqueNote;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherRemarksController extends Controller
{
    public function index(Request $request)
    {



            $levels =  Level::orderBy('created_at', 'asc')->get();

        return view('dashboard.teacherRemarks.index',compact('levels'))->withTitle(__('Teachers remark'))->withName(__('Remark'));;
    }

    public function loadModules( $classroom_id = null,$level_id = null)
    {
        // Grab all the classes
        $modules = Module::where('niveau_id','=',$level_id)->get();
        return view("dashboard.teacherRemarks.loadModules", [
            'modules' => $modules,
            'level_id' => $level_id ,
            'classroom_id' => $classroom_id ,
        ])->render();
    }
    public function loadNotes( $classroom_id = null,$level_id = null,$trimestre = null,$module_id= null)
    {
        $students = Student::where("niveau","=",$level_id)->where("class_id","=",$classroom_id)->get();

        return view("dashboard.teacherRemarks.loadNotes", [
            'level_id' => $level_id ,
            'classroom_id' => $classroom_id ,
            'students' => $students,
            'module_id' => $module_id,
            'trimestre' => $trimestre,
            'remarques' => RemarqueModule::all(),
        ])->render();
    }

    public function store(Request $request, $id)
    {

        $check = Validator::make($request->input(),[
            'student'              => 'required|array|min:1',
            "student.*"  => "required",

        ]);
        if($check->fails()){
            $arr = array('msg' => 'Something goes to wrong. Please try again lator', 'status' =>false);
            return response()->json($arr);
        }
        $trimestre=$request->get("trimestre") ;
        $lesson_id=$request->get("lesson_id") ;
        foreach($request->get("student") as $student){
            if($student["module_id"]!=-1){
                $data = moduleMoyenne::find($student["module_id"]);
            }else{
                $data=new moduleMoyenne();
                $data->student_id  = $student['student_id'];
                $data->module_id   = $student['module_id'];
            }
            $data->trimestre = $trimestre;
            $data->remarque_note_id  = $student['remarque_note_id'];
             $data->save();
        }

        $arr = array('msg' => 'Successfully Form Submit', 'status' => true);
        return response()->json($arr);

    }


}

