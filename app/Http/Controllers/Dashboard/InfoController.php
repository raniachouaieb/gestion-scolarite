<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\ClassroomInfo;
use App\Models\Info;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InfoController extends Controller
{
    public function index(){

        $informations = Info::all();
        $classes = Classroom::get();
        return view ('dashboard.information.index', compact('informations', 'classes'))->withTitle('Liste des informations');
    }

    public function add(){
        $niveaux=Level::get();

        return view ('dashboard.information.create',compact('niveaux'))->withTitle('Ajouter informations');

    }
    public function getClasse(Request $request){
        $html=[];
        $classe = Classroom::where('id_level', $request->get('niveau'))->get();
        foreach($classe as $class){
            $html[$class->id]=$class->name;
        }
        return $html;
    }

    public function store(Request $request)
    {

        try{
            $infos = Info::create([
               "titre"=>$request->titre,
                "info"=> $request->info,
                "class_id"=>$request->class,
            ]);
            //dd($infos);
            $infos->classes()->attach($request->get('class'));




            if($infos){
                Session::flash('statuscode', 'success');
                return redirect()->route('info.index')->with('status','information est envoyée avec succes');
            }else
                Session::flash('statuscode', 'error');
            return redirect()->route('info.index')->with('status','error');


        }catch(\Exception $ex){
            return $ex;
            return redirect()->route('info.index')->with(['status'=>'Error']);

        }

    }
    public function edit(Request $request, $id){
        $infos = Info::find($id);
        $niveaux = Level::get();
        $classe = Classroom::get();
        $levelName= ClassroomInfo::get();

        if(!$infos){
            return redirect()->route('info.index')->with(['error'=>'there is no data with this id, please enter a correct one']);
        }
        return view('dashboard.information.edit',compact('infos', 'niveaux','classe','levelName'))->withTitle('Edition information');
    }

    public function update(Request $request, $id){
        $infoID = Info::find($id);
        try{
            if(!$infoID){
                Session::flash('statuscode', 'error');

                return redirect()->route('info.index')->with(['status'=>'there is no data with this id, please enter a correct one']);
            }

            $dataInfoupdated =$infoID->update([
                'titre'=>$request->titre,
                'info'=>$request->info,
                'class_id'=>$request->class,
            ]);
            $infoID->classes()->sync($request->get('class'));


                Session::flash('statuscode', 'success');
                return redirect()->route('info.index')->with(['status'=>'Modification avec succés']);


        }catch(\Exception $exception){
            Session::flash('statuscode', 'error');
return $exception;
            return redirect()->route('info.index')->with(['status'=>'There is an error :(']);
        }


    }

    public function destroy($id){
        $infos = Info::find($id);
        $infos->delete();

        Session::flash('statuscode', 'error');
        return redirect()->route('info.index')->with('status','informaion est supprimée');
    }
}
