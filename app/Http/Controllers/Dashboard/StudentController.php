<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Parente;
use App\Models\Student;
use App\Models\Classroom;
use App\Models\Level;




class StudentController extends Controller
{
        public function __construct(){
            $this -> middleware('auth:admin');
         }

       public function index(){
           $niveaux = Level::orderBy('created_at', 'ASC')->get();

        //$student = Student::whereNotNull('classe')->get();
          // $studentClass = Student::with('class')->where('class_id', id);


           return view('dashboard.students.list-student-by-class',compact(  'niveaux'))->withTitle('Liste des eleves acceptée');

       }
    public function search(){
        $niveaux = Level::orderBy('created_at', 'ASC')->get();
        $class = Classroom::get();
        $search_text = $_GET['query'];
        $eleveByClass = Student::where('nomEleve', 'LIKE', '%'.$search_text.'%')->get();
        return view('dashboard.students.search', compact('eleveByClass', 'niveaux', 'class'));

    }

        public function eleveByClass(Request $req)
        {
            $niveaux = Level::orderBy('created_at', 'ASC')->get();
            $class = Classroom::get();


            $eleveByClass = Student::where('class_id', '=', $req->class)->paginate(PAGINATION);

            return view('dashboard.students.list-student',compact('eleveByClass', 'niveaux', 'class'));
        }

        public function elevePreInscrit(){
            $class = Classroom::get();
            $niveaux = Level::get();

            $elevePreInscrit = Student::whereNull('class_id')->get();
            return view('dashboard.students.list-student-preinscri', compact('elevePreInscrit', 'class', 'niveaux'));
        }

    public function getClasse(Request $request){
        $html=[];
        $classe = Classroom::where('id_level', $request->get('niveau'))->get();
        foreach($classe as $class){
            $html[$class->id]=$class->name;
        }
        return $html;
    }

        public function edit(Request $request, $id){

            $levels = Level::get();


            $student = Student::find($id);

           $classe= Classroom::get();
            //dd($classes);

            if(!$student){
               return redirect()->route('student.index')->with(['error'=>'there is no data with this id, please enter a correct one']);
            }
            return view('dashboard.students.edit-student',compact('student','levels','classe'))->withTitle('Edition fiche parent');
        }

    public function update(Request $request, $id){
        $eleveID = Student::find($id);
        try{
            if(!$eleveID){
                return redirect()->route('student.index')->with(['error'=>'there is no data with this id, please enter a correct one']);
            }
            $eleveID->update([
                'nomEleve'=>$request->nomEleve,
                'prenomEleve'=>$request->prenomEleve,
                "gender"=>$request->gender ,
                "niveau"=>$request->niveau,
                "class_id"=>$request->classe,
                'classe'=>$request->classe,
            ]);
            $eleveID->update($request->all());
            // DB::table('classerooms')
            //->update(['name'=> $request->name] );


            return redirect()->route('student.index')->with(['success'=>'Modification avec succés']);
        }catch(\Exception $exception){
            return $exception;
            return redirect()->route('student.index')->with(['error'=>'There is a error :(']);
        }


    }
}
