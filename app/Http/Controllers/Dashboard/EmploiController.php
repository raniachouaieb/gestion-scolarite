<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Emploi;
use App\Models\Level;
use Illuminate\Http\Request;
use App\Http\Requests\EmploiRequest;

use Illuminate\Support\Facades\Session;


class EmploiController extends Controller
{
    public function __construct(){
        $this -> middleware('auth:admin');
    }

    public function index(){

        $emplois = Emploi::all();
        $class = Classroom::get();


        return view ('dashboard.emploi.index', compact('emplois', 'class'))->withTitle('Liste des emplois');
    }

    public function add(){
        $emplois = Emploi::get();
        $niveaux = Level::get();
        $class = Classroom::get();

        return view('dashboard.emploi.store', compact('emplois', 'niveaux', 'class'))->withTitle('Ajouter emploi');

    }

    public function getClasse(Request $request){
        $html=[];
        $classe = Classroom::where('id_level', $request->get('niveau'))->get();
        foreach($classe as $class){
            $html[$class->id]=$class->name;
        }
        return $html;
    }

    public function store(EmploiRequest $request)
    {

        try {
            $emplois = new Emploi();
            $emplois->titre= $request->titre;
            $emplois->class_id= $request->class;
            $emplois->niveau_id =$request->niveau;

            $dataEmploi = $emplois->save();
            if($dataEmploi) {
                Session::flash('statuscode', 'success');
                return redirect()->route('emploi.index')->with('status', 'emploi est ajouté avec succes');
            }else

                Session::flash('statuscode', 'error');
            return redirect()->route('emploi.index')->with('status','emploi est error');

        }catch (\Exception $ex){
            return redirect()->route('emploi.index')->with(['status'=>'Error']);
        }


    }

    public function editEmploi($id){
        $emplois = Emploi::find($id);
        $niveaux = Level::get();
        $classes = Classroom::get();


        if(!$emplois){

            return redirect()->route('emploi.index')->with(['error'=>'there is no data with this id, please enter a correct one']);
        }
        return view('dashboard.emploi.edit',compact('emplois', 'niveaux', 'classes'))->withTitle('Edition emploi');
    }

    public function update(Request $request, $id){
        $emploiID = Emploi::find($id);
        try{
            if(!$emploiID){
                Session::flash('statuscode', 'error');

                return redirect()->route('emploi.index')->with(['status'=>'there is no data with this id, please enter a correct one']);
            }
            $emploiID->update([
                'titre'=>$request->titre,
                'class_id'=>$request->class,
            ]);
            $emploiID->update($request->all());

            Session::flash('statuscode', 'success');

            return redirect()->route('emploi.index')->with(['status'=>'Modification avec succés']);
        }catch(\Exception $exception){
            Session::flash('statuscode', 'error');

            return redirect()->route('emploi.index')->with(['status'=>'There is an error :(']);
        }


    }

    public function destroy($id){
        $emplois = Emploi::find($id);
        $emplois->delete();

        Session::flash('statuscode', 'error');
        return redirect()->route('emploi.index')->with('status','Cet emploi est annulée');
    }
}
