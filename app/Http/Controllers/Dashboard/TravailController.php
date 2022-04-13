<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Level;
use App\Models\Matiere;
use App\Models\Travail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Helpers\General;


class TravailController extends Controller
{
    public function __construct(){
        $this -> middleware('auth:admin');
    }

    public function index(){

        $travaux = Travail::all();
        $matieres = Matiere::get();
        $classes = Classroom::get();
        $niveaux =Level::get();

        return view ('dashboard.travaux.list-travaux', compact('travaux', 'matieres', 'niveaux','classes'))->withTitle('Liste des travaux');
    }

    public function add(){
        $travaux = Travail::get();
        $matieres = Matiere::get();
        $niveaux =Level::get();

        return view('dashboard.travaux.create-travail', compact('travaux', 'matieres', 'niveaux'))->withTitle('Envoyer un travail');

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
            $travaux = new Travail();
            $travaux->titre_travail= $request->titre_travail;
            $travaux->detail_travail= $request->detail_travail;
            $travaux->date_depot=$request->date_depot;
            $travaux->date_limite=$request->date_limite;
            $travaux->matiere_id=$request->matiere;
            $travaux->class_id=$request->class;
            if($request->has('image')) {
               // dd($request->input('image'));
                /*$name = time().'.' .explode('/',explode(':', substr($request->image, 0,
                        strpos($request->image, ';')))[1])[1];*/
                $path = uploadImage('travaux', $request->input('image'));
               dd($path);
               $travaux->file = $path;
            }
            $dataTravail =$travaux->save();
            if($dataTravail){
                Session::flash('statuscode', 'success');
                return redirect()->route('travails.index')->with('status','Travail est envoyée avec succes');
            }else
                Session::flash('statuscode', 'error');
            return redirect()->route('travails.index')->with('status','Convocation est error');


        }catch(\Exception $ex){
            return redirect()->route('travails.index')->with(['status'=>'Error']);

        }

    }

    public function edit(Request $request, $id){
        $travail = Travail::find($id);
        $classe = Classroom::get();
        $niveaux = Level::get();

        $matieres = Matiere::get();
        if(!$travail){
            Session::flash('statuscode', 'error');

            return redirect()->route('travails.index')->with(['status'=>'there is no data with this id, please enter a correct one']);
        }
        return view('dashboard.travaux.edit-travail',compact('travail', 'matieres', 'classe', 'niveaux'))->withTitle('Edition travail');
    }

    public function update(Request $request, $id){
        $travailId = Travail::find($id);
        try{
            if(!$travailId){
                Session::flash('statuscode', 'error');

                return redirect()->route('convocations.index')->with(['status'=>'there is no data with this id, please enter a correct one']);
            }
            $travailId->update([
                'titre_travail'=>$request->titre_travail,
                'detail_travail'=>$request->detail_travail,
                'date_depot'=>$request->date_depot,
                'date_limite'=>$request->date_limite,
                'matiere_id'=>$request->matiere,
                'class_id'=>$request->class,


            ]);
            $travailId->update($request->all());

            Session::flash('statuscode', 'success');

            return redirect()->route('travails.index')->with(['status'=>'Modification avec succés']);
        }catch(\Exception $exception){
            Session::flash('statuscode', 'error');

            return redirect()->route('travails.index')->with(['status'=>'There is an error :(']);
        }


    }

    public function destroy($id){
        $travaux = Travail::find($id);
        $travaux->delete();

        Session::flash('statuscode', 'error');
        return redirect()->route('travails.index')->with('status','Ce travail est annulée');
    }
}
