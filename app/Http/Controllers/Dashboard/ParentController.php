<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Parente;
use App\Models\Student;
use App\Models\Classroom;
use App\Models\Level;


use DB;

class ParentController extends Controller
{
    public function __construct(){
        $this -> middleware('auth:admin');
     }
   
       public function index(){
        $parent = Parente::with('student')->get();
       
           return view('dashboard.inscription.list-parent',compact('parent'));
           
       }

       public function edit(Request $request, $id){
         
         $levels = Level::with('class');
        
        $classes= Classroom::get();
        $parent = Parente::with('student')->find($id);
        /* foreach ($parent->student as $eleve)
         $eleve->select([
             "niveau"=>$request->niveau
         ]);*/
        //$classes = Classroom::where('id_level', $eleve)->get();
        //dd($parent);
        if(!$parent){
            return redirect()->route('inscri.index')->with(['error'=>'there is no data with this id, please enter a correct one']);
        }
        return view('dashboard.inscription.edit-info-parent',compact('parent'),compact('classes'))->withTitle('Edition fiche parent');
    }

    public function update(Request $request, $id){
       
        $parent = Parente::with('student')->find($id);        
        if(!$parent){
            return redirect()->route('inscri.index')->with(['error'=>'there is no data with this id, please enter a correct one']);
        }
        $parent->update([
            "nomPere"=>$request->nomPere,
            "prenomPere"=>$request->prenomPere,
            "professionPere"=> $request->professionPere,
            "telPere"=> $request->telPere,
            "nomMere"=> $request->nomMere,
            "prenomMere"=> $request->prenomMere,
            "professionMere"=> $request->professionMere,
            "telMere"=> $request->telMere,
            "nbEnfants"=> $request->nbEnfants,
            "adresse"=> $request->adresse,
            "email"=> $request->email,
            //"is_active"=>$request->is_active
        ]);
      //  $classStudent = Student::with('class')->find($id);

        return redirect()->route('inscri.index')->with(['success'=>'modification avec succés']);
    
    }

    public function updateEleve(Request $request, $id){
        //$parent = Parente::with('student')->find($id); 
        //dd($id);
    //foreach ($parent->student as $eleve)

           $updateleve= Student::find($id);
       // dd($request);  
        $updateleve->update([
            "nomEleve"=>$request->nomEleve,
            "prenomEleve"=>$request->prenomEleve,
            "gender"=>($request->gender == 'garcon')? 0:1,
            "niveau"=>$request->niveau,
            "classe"=>$request->classe,
            "class_id"=>$request->classe
        ]);
        return redirect()->route('inscri.index')->with(['success'=>'modification avec succés']);
    }
public function changeStatus( $id)
{
    $parent = DB::table('parentes')
              ->select('is_active')
              ->where('id','=', $id)
              ->first();

              if($parent->is_active == '1'){
                  $is_active = '0';
              }else{
                  $is_active= '1';
              }
              $values = array('is_active'=> $is_active);
              DB::table('parentes')->where('id',$id)->update($values);
    //$parent->is_active = $request->is_active;
    return redirect()->route('inscri.index')->with('status', 'status changed successfully');
    

    //return response()->json(['success'=>'Status change successfully.']);
}
}
      

