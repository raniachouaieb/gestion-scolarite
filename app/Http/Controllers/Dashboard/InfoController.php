<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\ClassroomInfo;
use App\Models\Info;
use App\Models\Level;
use App\Models\Student;
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
            //dd($request->class);

            $infos->classes()->attach($request->class);
            //////// for web

            $TokenForWeb =Student::where('class_id',$request->class)->join('parentes','parentes.id','students.parent_id')->whereNotNull('web_token')->pluck('web_token')->all();            $SERVER_API_KEY = 'AAAAbSlrGpc:APA91bGvt7wTQYZ5iKM7TsRaaKlzT4cUv-Ebz9MdBTkEnR1Dlk561ptGQtvzz8orNV2UqGzzUbSey0dLiFdGprZeZXI6E3Khq58JUTxTxVwC86H9AO-PG4KRxwsTkperWb1nFfODjI67';

            $notification = [
                "registration_ids" => $TokenForWeb,
                "notification" => [
                    "title" => "Vous-avez une nouveau convocation .",
                    "body" => $request->titre,
                    //  'date'=>$request->created_at,

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
            $firebaseToken = Student::where('class_id',$request->class)->join('parentes','parentes.id','students.parent_id')->whereNotNull('device_token')->pluck('device_token')->all();
            $SERVER_API_KEY = 'AAAAbSlrGpc:APA91bGvt7wTQYZ5iKM7TsRaaKlzT4cUv-Ebz9MdBTkEnR1Dlk561ptGQtvzz8orNV2UqGzzUbSey0dLiFdGprZeZXI6E3Khq58JUTxTxVwC86H9AO-PG4KRxwsTkperWb1nFfODjI67';
            $data = [

                "to" => $firebaseToken,
                "title" => "Vous-avez un nouveau information.",
                "body" =>$request->titre,
                "vibrate"=>[100,50,100],
            ];

            $headers = [

                'Content-Type: application/json',
                'accept: application/json',

            ];
            $dataString = json_encode($data);

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://exp.host/--/api/v2/push/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

            $response = curl_exec($ch);
//dd($response);
////// end notif for device




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
