<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\ClassroomRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Classroom;
use App\Models\Level;
use DB;
use Illuminate\Support\Facades\Session;


class ClassroomController extends Controller
{
    public function __construct(){
        $this -> middleware('auth:admin');
     }

       public function index(){
           $niveaux = Level::orderBy('created_at', 'ASC')->get();

           $class = Classroom::all();
           return view('dashboard.classroom.list-class-niveau', compact('class', 'niveaux'))->withTitle('Liste Classes');

       }
    public function classByLevel(Request $req){
        //$niveaux = Level::orderBy('created_at', 'ASC')->get();
        $classByLevel = Classroom::where('id_level', '=', $req->niveau)->get();

        return view('dashboard.classroom.list',compact( 'classByLevel'));

    }

       public function addClass(){
           $niveaux = Level::get();
           return view('dashboard.classroom.create', compact('niveaux'))->withTitle('Ajouter classe');

           }



       public function store(ClassroomRequest $request)
       {


        $class = Classroom::create([
            "name"=> $request->name,
            "id_level"=>$request->id_level

        ]);

           return redirect('admin/classes')->with('success','class has been added');

       }

       public function show($id){
           $class = Classroom::find($id);
          // return response()->json($class);
       }

       public function edit(Request $request, $id){
           $class = Classroom::find($id);
           $niveaux = Level::get();
           if(!$class){
               return redirect()->route('classes.index')->with(['error'=>'there is no data with this id, please enter a correct one']);
           }
           return view('dashboard.classroom.edit',compact('class', 'niveaux'))->withTitle('Edition classe');
       }

       public function update( Classroom $classroom, Request $request, $id){
            $classID = Classroom::find($id);
           try{
                if(!$classID){
                    return redirect()->route('classes.index')->with(['error'=>'there is no data with this id, please enter a correct one']);
                }
                $classUpdated = $classID->update([
                    'name'=>$request->name,
                    "id_level"=>$request->niveau
                ]);
                $classID->update($request->all());
               if($classUpdated && $request->all() === 'canceled'){
                   Session::flash('statuscode', 'success');
                   return redirect()->route('classes.index')->with(['status'=>'nothing updateted']);
               }else{
                   Session::flash('statuscode', 'success');
                   return redirect()->route('classes.index')->with(['status'=>'Modification avec succ??s']);
               }


           }catch(\Exception $exception){
               return redirect()->route('classes.index')->with(['error'=>'There is a error :(']);
           }


       }

       public function destroy($id){
           $class = Classroom::find($id);
           $class->delete();
           return redirect('/admin/classes')->with('success','class has been deleted');
       }
}
