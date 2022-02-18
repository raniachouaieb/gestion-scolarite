<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Classroom;

class ClassroomController extends Controller
{
    public function __construct(){
        $this -> middleware('auth:admin');
     }
   
       public function index(){
          
           $class = Classroom::all();
           return view('classroom.list', compact('class'));
           
       }
   
       public function addClass(Request $request){
           return view('classroom.create');
          
           }
          
   
   
       public function store(Request $request)
       {
           $class = new Classroom();
           $class->name= $request->name;
         
           $class->save();
           
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
           return view('classroom.edit',compact('class'));
       }
   
       public function update(Request $request, $id){
           $class = Classroom::find($id);
           if(!$class){
               return redirect()->route('classes.index')->with(['error'=>'there is no data with this id, please enter a correct one']);
           }
           $class->class= $request->class;
           $class->save();
           return redirect('/admin/classes');
   
       }
       
       public function destroy($id){
           $class = Classroom::find($id);
           $class->delete();
           return redirect('/admin/classes')->with('success','class has been deleted');
       }
}
