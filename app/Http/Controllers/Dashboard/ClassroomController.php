<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Classroom;
use App\Models\Level;

class ClassroomController extends Controller
{
    public function __construct(){
        $this -> middleware('auth:admin');
     }
   
       public function index(){
          
           $class = Classroom::all();
           return view('dashboard.classroom.list', compact('class'))->withTitle('Liste Classes');
           
       }
   
       public function addClass(){
           $niveaux = Level::get();
           return view('dashboard.classroom.create', compact('niveaux'))->withTitle('Ajouter classe');
          
           }
          
   
   
       public function store(Request $request)
       {
        $niveaux = Level::with('class');

        $class = Classroom::create([
            "name"=> $request->name,
            "id_level"=>$niveaux->id

        ]);
        //dd($request);

        
           //$class = new Classroom();
           //$class->name= $request->name;
           //$class->save();
           
           return redirect('admin/classes')->with('success','class has been added');
           //return response()->json($class);
   
       
       }
   
       public function show($id){
           $class = Classroom::find($id);
           return response()->json($class);
   
       }
   
       public function edit(Request $request, $id){
           $class = Classroom::find($id);
           if(!$class){
               return redirect()->route('classes.index')->with(['error'=>'there is no data with this id, please enter a correct one']);
           }
           return view('dashboard.classroom.edit',compact('class'))->withTitle('Edition classe');
       }
   
       public function update(Request $request, $id){
           return $classID = Classroom::find($id);
           try{
                if(!$classID){
                    return redirect()->route('classes.index')->with(['error'=>'there is no data with this id, please enter a correct one']);
                }

                $classID->update($request->all)->exept('_token');

                return redirect()->route('classes.index')->with(['success'=>'Modification avec succés']);
           }catch(Exception $exception){
               return redirect()->route('classes.index')->with(['error'=>'There is a error :(']);
           }

   
       }
       
       public function destroy($id){
           $class = Classroom::find($id);
           $class->delete();
           return redirect('/admin/classes')->with('success','class has been deleted');
       }
}
