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
    }

    public function index(){
       // $convocations = Convocation::all();

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

                $convocations = Convocation::where('titre_conv', 'LIKE', '%'.$query.'%')
                    ->get();

            }
            else{
                $convocations = Convocation::orderBy('date_envoie', 'DESC')->paginate(PAGINATION);
            }
            $total_row = $convocations->count();
            if($convocations && $total_row > 0){
                foreach($convocations as $row)
                {
                    $output .= '
                    <tr>
                        <td>'.$row->titre_conv.'</td>
                        <td>'.$row->description.'</td>
                        <td>'.$row->date_envoie.'</td>
                        <td>'.$row->student['nomEleve'].' '.$row->student['prenomEleve'].'</td>
                        <td>'.$row->student->parent['nomPere'].' '.$row->student->parent['prenomPere'].'</td>
                        <td>'.$row->student->parent['telPere'].'</td>
                        <td><form action="" method="post" class="d-inline" >
                        <input name="_method" type="hidden" value="DELETE">
                        <a type="submit"  class=" show_confirm iconSupp" data-toggle="tooltip" ><i class="fas fa-trash trashcolor"></i></a>
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
            $convocations = array(
                'table_data' => $output,
                'total_data' => $total_data
            );
            echo json_encode($convocations);

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

    public function edit(Request $request, $id){
        $convocations = Convocation::find($id);
        $niveaux =Level::get();
        $students =Student::find($convocations->student_id);
        //$classe =Classroom::where('id-level' ,$students->niveau)->get();
        //dd($classe);



        if(!$convocations){
            Session::flash('statuscode', 'error');

            return redirect()->route('convocations.index')->with(['status'=>'there is no data with this id, please enter a correct one']);
        }
        return view('dashboard.convocation.edit-conv',compact('convocations', 'niveaux', 'students'))->withTitle('Edition Convocation');
    }

    public function update(Request $request, $id){
        $convocationsID = Convocation::find($id);
        try{
            if(!$convocationsID){
                Session::flash('statuscode', 'error');

                return redirect()->route('convocations.index')->with(['status'=>'there is no data with this id, please enter a correct one']);
            }
            $convocationsID->update([
                'titre_conv'=>$request->titre_conv,
                'description'=>$request->description,
                'date_envoie'=>$request->date_envoie,
            ]);
            $convocationsID->update($request->all());

            Session::flash('statuscode', 'success');

            return redirect()->route('convocations.index')->with(['status'=>'Modification avec succés']);
        }catch(\Exception $exception){
            Session::flash('statuscode', 'error');

            return redirect()->route('convocations.index')->with(['status'=>'There is an error :(']);
        }


    }

    public function destroy($id){
        $convocations = Convocation::find($id);
        $convocations->delete();

        Session::flash('statuscode', 'error');
        return redirect()->route('convocations.index')->with('status','Cette convocation est annulée');
    }
}
