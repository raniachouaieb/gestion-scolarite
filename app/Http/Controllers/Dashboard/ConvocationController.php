<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConvocationRequest;
use App\Models\Classroom;
use App\Models\Convocation;
use App\Models\Level;
use App\Models\Parente;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class ConvocationController extends Controller
{
    public function __construct(){
        $this -> middleware('auth:admin');
        $this->middleware('permission:convocation-list|convocation-create|convocation-edit|convocation-delete', ['only' => ['index','store']]);

    }

    public function index(){

        $convocations = Convocation::orderBy('date_envoie', 'DESC')->paginate(PAGINATION);

        return view ('dashboard.convocation.list-convocation', compact('convocations'))->withTitle('Liste des convocations');
    }

    public function search(Request $req){
        if($req->ajax()){
            $output='';
            $total_data='';
            $query = $req->get('query');
            if($query !='')
            {
                $convocationsS = Convocation::where('titre_conv', 'LIKE', '%'.$query.'%')
                    ->get();
            }
            else{
                $convocationsS = Convocation::orderBy('date_envoie', 'DESC')->paginate(PAGINATION);
            }
            $total_row = $convocationsS->count();

            if($convocationsS && $total_row > 0){
                foreach($convocationsS as $row)
                {
                    $output .= '
                    <tr>
                        <td>'.$row->titre_conv.'</td>
                        <td>'.$row->description.'</td>
                        <td>'.$row->date_envoie.'</td>
                        <td>'.$row->student['nomEleve'].' '.$row->student['prenomEleve'].'</td>
                        <td>'.$row->student->parent['nomPere'].' '.$row->student->parent['prenomPere'].'</td>
                        <td>'.$row->student->parent['telPere'].'</td>
                        <td><form action="'.route('convocations.destroy', $row->id).'" method="post" class="d-inline" >
                        <!-- WLD -->
                             '.csrf_field().'
                             <button type="submit" class=" show_confirm iconSupp" data-toggle="tooltip"  value="Submit" style="border: none;"><i class="fas fa-trash trashcolor"></i> Submit</button>

                                        </form>
                    </form>
                    </td>
                     </tr>';
                }
            }
            else{
                $output = '
                <tr>
                <td class="nodata" colspan="5">No data</td>
                </tr>';
            }
            $convocationsS = array(
                'table_data' => $output,
                'total_data' => $total_data
            );
            echo json_encode($convocationsS);

        }

    }

    public function addConv(){
        $convocations = Convocation::get();
        $niveaux = Level::get();

        return view('dashboard.convocation.create-conv', compact('convocations', 'niveaux'))->withTitle('Envoyer une convocation');

    }

    public function getClasse(Request $request){
        $html=[];
        $classe = Classroom::where('id_level', $request->get('niveau'))->get();
        foreach($classe as $class){
            $html[$class->id]=$class->name;
        }
        return $html;
    }

    public function getEleve(Request $request){
        $html=[];
        $eleves = Student::where('class_id', $request->get('class'))->get();
        foreach($eleves as $elev){
            $html[$elev->id]=$elev->nomEleve.' '.$elev->prenomEleve;

        }
        return $html;
    }

   /* public function searchConv(){
        $search_text = $_GET['query'];
        $convocations = Convocation::where('titre_conv', 'LIKE', '%'.$search_text.'%')->get();
         return view('dashboard.convocation.search', compact('convocations'));

    }*/

    public function store(ConvocationRequest $request)
    {
        try {
            $convocations = new Convocation();
            $convocations->titre_conv= $request->titre_conv;
            $convocations->description= $request->description;
            $convocations->date_envoie=$request->date_envoie;
            $convocations->student_id=$request->elev;
            $dataStatus = $convocations->save();


            //////// for web

            $TokenForWeb =Student::join('parentes','parentes.id','students.parent_id')->where('students.id',$request->elev)->whereNotNull('web_token')->pluck('web_token')->all();

            $SERVER_API_KEY = 'AAAAbSlrGpc:APA91bGvt7wTQYZ5iKM7TsRaaKlzT4cUv-Ebz9MdBTkEnR1Dlk561ptGQtvzz8orNV2UqGzzUbSey0dLiFdGprZeZXI6E3Khq58JUTxTxVwC86H9AO-PG4KRxwsTkperWb1nFfODjI67';

            $notification = [
                "registration_ids" => $TokenForWeb,
                "notification" => [
                    "title" => "Vous-avez une nouveau convocation .",
                    "body" => $request->titre_conv,
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
            $firebaseToken = Student::join('parentes','parentes.id','students.parent_id')->where('students.id',$request->elev)->whereNotNull('device_token')->pluck('device_token')->all();
            $data = [

                "to" => $firebaseToken,
                "title" => "Vous-avez un nouveau Convocation.",
                "body" =>$request->titre_conv,
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

////// end notif for device


            if($dataStatus) {
                Session::flash('statuscode', 'success');
                return redirect()->route('convocations.index')->with('status', 'Convocation est envoyée avec succes');
            }else

            Session::flash('statuscode', 'error');
            return redirect()->route('convocations.index')->with('status','Convocation est error');

        }catch (\Exception $ex){
            //return $ex;
            return redirect()->route('convocations.index')->with(['status'=>'Error']);
        }


    }

    public function destroy($id){
        $convocations = Convocation::find($id);

        $convocations->delete();

        Session::flash('statuscode', 'error');
        return redirect()->route('convocations.index')->with('status','Cette convocation est annulée');
    }
}
