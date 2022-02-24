<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Parente;
use App\Models\Student;

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
        $parent = Parente::with('student')->find($id);
        //dd($parent);
        if(!$parent){
            return redirect()->route('inscri.index')->with(['error'=>'there is no data with this id, please enter a correct one']);
        }
        return view('dashboard.inscription.edit-info-parent',compact('parent'))->withTitle('Edition fiche parent');
    }

    public function update(Request $request, $id){
        $parent = Parente::find($id);
        if(!$parent){
            return redirect()->route('inscri.index')->with(['error'=>'there is no data with this id, please enter a correct one']);
        }

        $parent->nomPere= $request->nomPere;
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
        $parent->save();

        


        return redirect()->route('inscri.index');

    }
   
      
}
