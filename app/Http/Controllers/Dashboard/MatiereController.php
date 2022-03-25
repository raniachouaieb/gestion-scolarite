<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Matiere;
use App\Models\Module;
use App\Http\Requests\MatiereRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MatiereController extends Controller
{
    public function __construct(){
        $this -> middleware('auth:admin');
    }

    public function index(){

        $matiere = Matiere::all();
        $module= Module::get();


        return view ('dashboard.matiere.list-matiere', compact('matiere', 'module'))->withTitle('Liste des matières');
    }


    public function addMatiere(){
        $modules = Module::get();
        return view('dashboard.matiere.create-matiere', compact('modules'))->withTitle('Ajouter matiere');

    }



    public function store(MatiereRequest $request)
    {
        $matiere = new Matiere();
        $matiere->nom= $request->nom;
        $matiere->coefficient= $request->coeff;
        $matiere->module_id=$request->module;

        $matiere->save();

        Session::flash('statuscode', 'success');
        return redirect()->route('matieres.index')->with('status','Matiere est ajoutée avec ucces');


    }

    public function edit(Request $request, $id){
        $matiere = Matiere::find($id);
        $modules = Module::get();
        if(!$matiere){
            Session::flash('statuscode', 'error');

            return redirect()->route('matieres.index')->with(['status'=>'there is no data with this id, please enter a correct one']);
        }
        return view('dashboard.matiere.edit-matiere',compact('matiere', 'modules'))->withTitle('Edition matiere');
    }

    public function update(Request $request, $id){
        $matiereID = Matiere::find($id);
        try{
            if(!$matiereID){
                Session::flash('statuscode', 'error');

                return redirect()->route('matieres.index')->with(['status'=>'there is no data with this id, please enter a correct one']);
            }
            $matiereID->update([
                'nom'=>$request->nom,
                'coefficient'=>$request->coeff,
                'module_id'=>$request->module,
            ]);
            $matiereID->update($request->all());

            Session::flash('statuscode', 'success');

            return redirect()->route('matieres.index')->with(['status'=>'Modification avec succés']);
        }catch(\Exception $exception){
            Session::flash('statuscode', 'error');

            return redirect()->route('matieres.index')->with(['status'=>'There is an error :(']);
        }


    }

    public function destroy($id){
        $matiere = Matiere::find($id);
        $matiere->delete();

        Session::flash('statuscode', 'error');
        return redirect()->route('matieres.index')->with('status','la suppression de cet matiere {{$matiere->nom}} est effectuée avec succes');
    }
}