<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Enseignant;
use App\Models\Module;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class EnseignantController extends Controller
{

    public function index(){
        $modules = Module::get();
        $enseignants= Enseignant::paginate(PAGINATION);
        return view('dashboard.enseignants.index', compact('enseignants', 'modules'))->withTitle('liste enseignants');

    }

    public function add(){
        $roles = Role::all();

        $niveaux = Level::get();

        return view('dashboard.enseignants.create', compact('roles','niveaux'))->withTitle('Ajouter enseignant');
    }
    public function getModule(Request $request){
        $html=[];
        $module = Module::where('niveau_id', $request->get('niveau'))->get();
        foreach($module as $modul){
            $html[$modul->id]=$modul->nom_module;
        }
        return $html;
    }

    public function create(Request $request){
        $enseignant = new Enseignant();
        $enseignant->nom= $request->nom;
        $enseignant->prenom= $request->prenom;
        $enseignant->gender=($request->gender =='homme')? 0:1;
        $enseignant->etat_matrimonial=($request->etat_matrimonial =='mariee')?1:0;
        $enseignant->status=isset($request->status) ? 1 : 0;
        $enseignant->date_naiss=$request->date_naiss;
        $enseignant->annee_obt_diplome=$request->annee_obt_diplome;
        $enseignant->ans_exp=$request->ans_exp;
        $enseignant->specilaite=$request->specilaite;
        $enseignant->date_embauche=$request->date_embauche;
        $enseignant->telephone=$request->telephone;
        $enseignant->adresse=$request->adresse;
        $enseignant->email=$request->email;
        $enseignant->password=$request->password;
        $enseignant->role=$request->role;
        $enseignant->module_id=$request->modul;
        if($request->hasfile('image_profile')){

            $path = uploadImage('enseignants',$request->file('image_profile'));
            if(File::exists($path))
            {
                File::delete($path);
            }
            $enseignant->image= $path;
        }
        $enseignant->assignRole($request->input('role'));

        $enseignant->save();
        $enseignant->modules()->attach($request->get('modul'));
        Enseignant::sendPasswordEmail($enseignant);


        Session::flash('statuscode', 'success');
        return redirect()->route('enseignants')->with('status','enseignant est ajoutée avec succes');



    }
    public function edit(Request $request, $id){
        $enseignant = Enseignant::find($id);
        $niveaux = Level::get();
        $modules= Module::get();
        $roles =Role::all();

        if(!$enseignant){
            return redirect()->route('info.index')->with(['error'=>'there is no data with this id, please enter a correct one']);
        }
        return view('dashboard.enseignants.edit',compact('enseignant', 'niveaux','modules','roles'))->withTitle('Edition fiche enseignant');
    }

    public function update(Request $request, $id){
        $enseignantId = Enseignant::find($id);
        try{
            if(!$enseignantId){
                Session::flash('statuscode', 'error');

                return redirect()->route('enseignants')->with(['status'=>'there is no data with this id, please enter a correct one']);
            }

            $enseignantId->nom= $request->nom;
            $enseignantId->prenom=$request->prenom;
            $enseignantId->adresse=$request->adresse;
            $enseignantId->telephone=$request->telephone;
            $enseignantId->date_embauche=$request->date_embauche;
            $enseignantId->specilaite=$request->specilaite;
            $enseignantId->date_naiss=$request->date_naiss;
            $enseignantId->annee_obt_diplome=$request->annee_obt_diplome;
            $enseignantId->email=$request->email;
            $enseignantId->password=$request->password;
            $enseignantId->status=isset($request->status) ? 1 : 0;
            $enseignantId->gender=($request->gender == 'garcon')? 0:1;
            $enseignantId->etat_matrimonial=($request->etat_matrimonial == 'mariee')? 1:0;
            $enseignantId->ans_exp=$request->ans_exp;
            $enseignantId->role=$request->role;
            $enseignantId->module_id=$request->modul;
            if($request->hasfile('image_profile')){

                $path = uploadImage('enseignants',$request->file('image_profile'));
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $enseignantId->image= $path;
            }


            $enseignantId->update();
            $enseignantId->classes()->sync($request->get('modul'));
            Enseignant::sendPasswordEmail($enseignantId);



            Session::flash('statuscode', 'success');
            return redirect()->route('enseignants')->with(['status'=>'Modification avec succés']);


        }catch(\Exception $exception){
            Session::flash('statuscode', 'error');

            return redirect()->route('enseignants')->with(['status'=>'There is an error :(']);
        }


    }
    public function changeStatus( $id, Request $request)
    {
        try {
            //$getStatus= Admin::select('status')->where('id', $id)->first();
            $enseignant = Enseignant::get();
            $role = Role::get();
            $getStatus = Enseignant::select('status')->find($id);
            //dd($getStatus);
            //return $getStatus;
            if($getStatus->status == 'Active'){
                $getStatus::where('id', $id)->update(['status'=>0]);
            }else{
                $getStatus::where('id', $id)->update(['status'=>1]);
            }
            Session::flash('statuscode', 'succes');
            return redirect()->route('enseignants')->with(['status'=>'l etat du l enseignant est changé avec succées'])->withTitle('liste enseignants');;
            //return view('dashboard.admin.home',compact('admin','role'))->with(['status'=>'changed'])->withTitle('list users');
            //return $getStatus;
        }catch (\Exception $exception){
            //return $exception;
            //return view('dashboard.users.list_users',compact('admin','role'))->with(['status'=>'No'])->withTitle('list users');
        }

    }

    public function destroy($id){
        $ens = Enseignant::find($id);
        $ens->delete();

        Session::flash('statuscode', 'error');
        return redirect()->route('enseignants')->with('status','enseignant est supprimé');
    }
}
