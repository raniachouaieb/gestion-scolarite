<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\ParentRequest;
use App\Http\Requests\StudentRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Parente;
use App\Models\Student;
use App\Models\Classroom;
use App\Models\Level;


use DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ParentController extends Controller
{
    public function __construct(){
        $this -> middleware(['auth:admin', 'verified']);
     }

       public function index(){
        $parent = Parente::with('students')->where('is_active' , 0)->get();

           return view('dashboard.inscription.list-parent',compact('parent'));

       }

    public function listAccepted(Request $req){
        $niveaux = Level::orderBy('created_at', 'ASC')->get();
        //$parent = Parente::with('students')->where('is_active', 1)->paginate(PAGINATION);

        return view('dashboard.inscription.list-parent-by-classe',compact('niveaux'));

    }
    public function listReject(Request $req){
        $parent = Parente::with('students')->where('is_active' , 2)->get();

        return view('dashboard.inscription.list-reject',compact('parent'));

    }
    public function parentByClass(Request $req)
    {
        $niveaux = Level::orderBy('created_at', 'ASC')->get();

        $parentByClasse = Parente::whereHas('students', function ($query) use ($req) {
            $query->where('class_id', '=', $req->class);
        })->where('is_active',1)->paginate(PAGINATION);

        return view('dashboard.inscription.list_accepte',compact('parentByClasse', 'niveaux'));
    }

    public function getClasse(Request $request){
        $html=[];
        $classe = Classroom::where('id_level', $request->get('niveau'))->get();
        foreach($classe as $class){
            $html[$class->id]=$class->name;
        }
        return $html;
    }




       public function edit(Request $request, $id){

        $levels = Level::get();


        $parent = Parente::with('students')->find($id);

           $classes= Classroom::get();
           //dd($classes);

        if(!$parent){
            return redirect()->route('inscri.index')->with(['error'=>'there is no data with this id, please enter a correct one']);
        }
        return view('dashboard.inscription.edit-info-parent',compact('parent','classes','levels'))->withTitle('Edition fiche parent');
    }

    public function update(Request $request, $id){


        $parent = Parente::with('students')->find($id);
        if(!$parent){
            return redirect()->route('inscri.index')->with(['error'=>'there is no data with this id, please enter a correct one']);
        }
        $parent->nomPere= $request->nomPere;
        $parent->prenomPere=$request->prenomPere;
        $parent->professionPere=$request->professionPere;
        $parent->telPere=$request->telPere;
        $parent->nomMere=$request->nomMere;
        $parent->prenomMere=$request->prenomMere;
        $parent->professionMere=$request->professionMere;
        $parent->telMere=$request->telMere;
        $parent->nbEnfants=$request->nbEnfants;
        $parent->adresse=$request->adresse;
        $parent->email=$request->email;
        $parent->email=$request->email;
//        $parent->is_active=$request->is_active == 'accepter' ? 1:0;

        if($request->status === 'rejeter'){
            $parent->is_active=2;
        } elseif($request->status === 'accepter'){
            $parent->is_active=1;
        }else{
            $parent->is_active=0;
        }


        if($request->hasfile('image_profile')){

            $path = uploadImage('parents',$request->file('image_profile'));
            if(File::exists($path))
            {
                File::delete($path);
            }
            $parent->image_profile= $path;
        }
        $parent->update();
        return redirect()->route('inscri.list_accepted')->with(['success'=>'modification avec succés']);

    }

    public function updateEleve(Request $request, $id){

           $updateleve= Student::find($id);
       // dd($request);
        $updateleve->update([
            "nomEleve"=>$request->nomEleve,
            "prenomEleve"=>$request->prenomEleve,
            "gender"=>($request->gender == 'garcon')? 0:1,
            "niveau"=>$request->niveau,
            "class_id"=>$request->classe,
            'classe'=>$request->classe,
            "birth"=>$request->birth
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
public function add(){
        $niveaux = Level::get();
        return view('dashboard.inscription.create', compact('niveaux'))->withTitle('Ajouter parent');
}

public function store(ParentRequest $request, StudentRequest $req)
{
    try{
        $parent = Parente::create([
            "nomPere" => $request->nomPere,
            "prenomPere" => $request->prenomPere,
            "professionPere" => $request->professionPere,
            "telPere" => $request->telPere,
            "nomMere" => $request->nomMere,
            "prenomMere" => $request->prenomMere,
            "professionMere" => $request->professionMere,
            "telMere" => $request->telMere,
            "nbEnfants" => $request->nbEnfants,
            "adresse" => $request->adresse,
            "email" => $request->email,
            "password" => Hash::make($request->password),


        ]);
        $parent->sendEmailVerificationNotification();
        $students = [];
       //dd($request);

            Student::create([
                "nomEleve" => $req->nomEleve,
                "prenomEleve" => $req->prenomEleve,
                "niveau" => $req->niveau,
                "gender" => ($req->gender == 'garcon') ? 0 : 1,
                "birth" => $req->birth,
                "parent_id" => $parent->id,


            ]);


        return redirect()->route('inscri.index')->with('success', ' You are now registred successfully! Please check your email to verification link!');

    }catch(\Exception $ex){
        return $ex;
    }




    }
}


