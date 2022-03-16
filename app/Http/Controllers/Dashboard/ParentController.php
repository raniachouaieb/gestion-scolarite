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
        $this -> middleware(['auth:admin', 'verified']);
     }

       public function index(){
        $parent = Parente::with('student')->where('is_active' , 0)->get();

           return view('dashboard.inscription.list-parent',compact('parent'));

       }

    public function listAccepted(){
        $parent = Parente::with('student')->where('is_active', 1)->get();

        return view('dashboard.inscription.list_accepte',compact('parent'));

    }


       public function edit(Request $request, $id){

        $levels = Level::get();


        $parent = Parente::with('student')->find($id);

           $classes= Classroom::get();
           //dd($classes);

        if(!$parent){
            return redirect()->route('inscri.index')->with(['error'=>'there is no data with this id, please enter a correct one']);
        }
        return view('dashboard.inscription.edit-info-parent',compact('parent','classes','levels'))->withTitle('Edition fiche parent');
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
            "is_active"=>($request->is_active == 'rejeter')? 0:1,
        ]);


        return redirect()->route('inscri.index')->with(['success'=>'modification avec succés']);

    }

    public function updateEleve(Request $request, $id){

           $updateleve= Student::find($id);
       // dd($request);
        $updateleve->update([
            "nomEleve"=>$request->nomEleve,
            "prenomEleve"=>$request->prenomEleve,
            "gender"=>($request->gender == 'garcon')? 0:1,
            "niveau"=>$request->niveau,
            "classe"=>$request->classe,
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

    return redirect()->route('inscri.index')->with('status', 'status changed successfully');


    //return response()->json(['success'=>'Status change successfully.']);
}
}


