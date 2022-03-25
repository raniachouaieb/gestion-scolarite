<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Matiere;
use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Requests\ModuleRequest;;
use Illuminate\Support\Facades\Session;

class ModuleController extends Controller
{
    public function __construct(){
        $this -> middleware('auth:admin');
    }

    public function index(){

        $module = Module::all();
        $matiere= Matiere::with('module');


        return view ('dashboard.module.list-module', compact('module','matiere'))->withTitle('Liste des modules');
    }


    public function addModule(){
        $niveaux = Level::get();

        return view('dashboard.module.create-module', compact('niveaux'))->withTitle('Ajouter module');

    }



    public function store(ModuleRequest $request)
    {
        $module = new Module();
        $module->nom_module= $request->nom_module;
        $module->coefficient_module= $request->coefficient_module;
        $module->niveau_id=$request->niveau_id;

        $module->save();

        Session::flash('statuscode', 'success');
        return redirect()->route('modules.index')->with('status','Module est ajouté avec succes');
    }

    public function show($id){
        $module = Module::with('matiere')->find($id);
       // $matiere= Matiere::with('module');


        return view('dashboard.module.list-module', compact('module'));
    }

    public function edit(Request $request, $id){
        $module = Module::find($id);
        $niveaux = Level::get();
        if(!$module){
            Session::flash('statuscode', 'error');

            return redirect()->route('modules.index')->with(['status'=>'there is no data with this id, please enter a correct one']);
        }
        return view('dashboard.module.edit-module',compact('module', 'niveaux'))->withTitle('Edition matiere');
    }

    public function update(Request $request, $id){
        $moduleID = Module::find($id);
        try{
            if(!$moduleID){
                Session::flash('statuscode', 'error');

                return redirect()->route('matieres.index')->with(['status'=>'there is no data with this id, please enter a correct one']);
            }
            $moduleID->update([
                'nom_module'=>$request->nomModule,
                'coefficient_module'=>$request->coeffModule,
                'niveau_id'=>$request->niveau_id
            ]);
            $moduleID->update($request->all());

            Session::flash('statuscode', 'success');

            return redirect()->route('modules.index')->with(['status'=>'Modification avec succés']);
        }catch(\Exception $exception){
            Session::flash('statuscode', 'error');

            return redirect()->route('modules.index')->with(['status'=>'There is an error :(']);
        }


    }

    public function destroy($id){
        $module = Module::find($id);
        $module->delete();

        Session::flash('statuscode', 'error');
        return redirect()->route('modules.index')->with('status','la suppression de ce module est effectuée avec succes');
    }
}