<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Parente;
use App\Models\Student;
use App\Models\Classroom;

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
         $classes = Classroom::get();

        $parent = Parente::with('student')->find($id);
        //dd($parent);
        if(!$parent){
            return redirect()->route('inscri.index')->with(['error'=>'there is no data with this id, please enter a correct one']);
        }
        return view('dashboard.inscription.edit-info-parent',compact('parent'),compact('classes'))->withTitle('Edition fiche parent');
    }

    public function update(Request $request, $id){
        //$eleve = Student::find($id);
       
        $parent = Parente::with('student')->find($id);
        try{
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
            "is_active"=>$request->is_active
        ]);

  foreach ($parent->student as $eleve)
        $eleve->update([
            "nomEleve"=>$request->nomEleve,
            "prenomEleve"=>$request->prenomEleve,
            "gender"=>($request->gender == 'garcon')? 0:1,
            "niveau"=>$request->niveau,
            "classe"=>$request->classe,
           // "class_id"=>$classes->id
        ]);
   
       
           /* DB::table('students')
        ->update([
            "nomEleve"=>$request->nomEleve,
            "prenomEleve"=>$request->prenomEleve,
            
        ]);*/

        /*$parent->nomPere= $request->nomPere;
        $parent->prenomPere= $request->prenomPere;
        $parent->professionPere= $request->professionPere;
        $parent->telPere= $request->telPere;
        $parent->nomMere= $request->nomMere;
        $parent->prenomMere= $request->prenomMere;
        $parent->professionMere= $request->professionMere;
        $parent->telMere= $request->telMere;
        $parent->nbEnfants= $request->nbEnfants;
        $parent->adresse= $request->adresse;
        $parent->email= $request->email;
        $parent->save();*/

        


        return redirect()->route('inscri.index')->with(['success'=>'modification avec succés']);
    }catch(\Exception $exception){
        return redirect()->route('inscri.index')->with(['error'=>'There is a error :(']);
    }
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
      

