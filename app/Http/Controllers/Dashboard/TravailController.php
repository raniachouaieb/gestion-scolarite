<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Level;
use App\Models\Matiere;
use App\Models\Student;
use App\Models\Travail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use App\Helpers\General;

class TravailController extends Controller
{
    public function __construct(){
        $this -> middleware('auth:admin');
    }

    public function index(){

        $travaux = Travail::orderBy('created_at', 'DESC')->get();
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
            //add check value
            $path = (!$request->file('image')) ? '' : $request->file('image')->getClientOriginalExtension();
            $travaux = new Travail();
            $travaux->titre_travail= $request->titre_travail;
            $travaux->detail_travail= $request->detail_travail;
            $travaux->date_depot=$request->date_depot;
            $travaux->date_limite=$request->date_limite;
            $travaux->matiere_id=$request->matiere;
            $travaux->class_id=$request->class;
            $travaux->extension=$path;
            if($request->hasfile('image')) {
                $path = uploadImage('travaux', $request->file('image'));
               //dd($path);

               // dd($travaux->file= $request->file('image')->getClientOriginalExtension());
               $travaux->file = $path;



            }
            $dataTravail =$travaux->save();
            //////// for web

            $TokenForWeb = $eleves=Student::where('class_id',$request->class)->join('parentes','parentes.id','students.parent_id')->whereNotNull('web_token')->pluck('web_token')->all();

            $SERVER_API_KEY = 'AAAAvJ7-CHM:APA91bGbmOzhhiXi2S5MPHYqgEqktr-CahZlgK4YH0qQ_Oc7X1_B1RgIHlmLFBnnqUdEfayn2sXHDj38XPXiSxYmHSTQsPpkmLjcuPrbNPVeuFbRFvAEhdlhCTkbw2o5Rzq0aZZ21ExB';

            $notification = [
                "registration_ids" => $TokenForWeb,
                "notification" => [
                    "title" => "Vous-avez un nouveau travail à faire .",
                    "body" => $request->titre_travail,
                    'date'=>$request->created_at,

                ]
            ];
            $notifString = json_encode($notification);

            $headersWeb = [
                'Authorization: key=' . $SERVER_API_KEY,
                'Content-Type: application/json',
            ];

            $ch2 = curl_init();

            curl_setopt($ch2, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch2, CURLOPT_POST, true);
            curl_setopt($ch2, CURLOPT_HTTPHEADER, $headersWeb);
            curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch2, CURLOPT_POSTFIELDS, $notifString);

            $response = curl_exec($ch2);
//////// end for web
            ////// for device
//
//            $firebaseToken = $eleves=eleve::where('classe_id',$req->class)->join('parents','parents.id','eleves.parent_id')->whereNotNull('device_token')->pluck('device_token')->all();
//            $data = [
//
//                "to" => $firebaseToken,
//                "title" => "Vous-avez un nouveau information.",
//                "body" =>$req->titre,
//                "vibrate"=>[100,50,100],
//            ];
//
//            $headers = [
//
//                'Content-Type: application/json',
//                'accept: application/json',
//
//            ];
//            $dataString = json_encode($data);
//
//            $ch = curl_init();
//
//            curl_setopt($ch, CURLOPT_URL, 'https://exp.host/--/api/v2/push/send');
//            curl_setopt($ch, CURLOPT_POST, true);
//            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
//
//            $response = curl_exec($ch);
//dd($response);
////// end notif for device
            if($dataTravail){
                Session::flash('statuscode', 'success');
                return redirect()->route('travails.index')->with('status','Travail est envoyée avec succes');
            }else
                Session::flash('statuscode', 'error');
            return redirect()->route('travails.index')->with('status','Convocation est error');


        }catch(\Exception $ex){
            return $ex;
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
            $travailId->titre_travail= $request->titre_travail;
            $travailId->detail_travail=$request->detail_travail;
            $travailId->date_depot=$request->date_depot;
            $travailId->date_limite=$request->date_limite;
            $travailId->matiere_id=$request->matiere;
            $travailId->class_id=$request->class;

            $path = (!$request->file('image')) ? '' : $request->file('image')->getClientOriginalExtension();

            $travailId->extension=$path;
            if($request->hasfile('image')) {
                $path = uploadImage('travaux', $request->file('image'));
                $travailId->file = $path;

            }
            if($request->hasfile('image')){

                $path = uploadImage('travaux',$request->file('image'));
                /*if(File::exists($path))
                {
                    File::delete($path);
                }*/



                $travailId->file = $path;
            }
            //dd($travailId);

            $travailId->update();

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

    public function  download(Request $req,$file){

        return response()->download(asset('assets/'.$file));
    }
    public function view($id){
        $travail=Travail::find($id);
        return view('dashboard.travaux.viewPDF', compact('travail'));

    }
}
