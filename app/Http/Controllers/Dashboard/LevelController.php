<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\LevelRequest;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Level;
use Session;

class LevelController extends Controller
{

  public function __construct(){
     $this -> middleware('auth:admin');
  }

    public function index(){

        $levelName = Level::orderBy('id', 'ASC')->get();
        //return $levelName;
        return view ('dashboard.level.list', compact('levelName'))->withTitle('Liste des niveaux');
    }

    public function addLevel(Request $request){
        //$levelName = Level::all();
        return view('dashboard.level.create');

        }



    public function store(LevelRequest $request)
    {
        $levelName = new Level();
        $levelName->level= $request->level;

        $levelName->save();

        Session::flash('statuscode', 'success');
        return redirect('admin/levels')->with('status','Level has been added');
        //return response()->json($levelName);


    }

    public function show($id){
        $levelName = Level::find($id);
        return response()->json($levelName);

    }

    public function edit(Request $request, $id){
        $level = Level::find($id);
        if(!$level){
            return redirect()->route('levels.index')->with(['error'=>'there is no data with this id, please enter a correct one']);
        }
        return view('dashboard.level.edit',compact('level'));
    }

    public function update(Request $request, $id){
        $levelID = Level::find($id);
        try{
            if(!$levelID){
                return redirect()->route('permissions')->with(['error'=>'there is no data with this id, please enter a correct one']);
            }
            $levelUpdated = $levelID->update([
                'level'=>$request->level,

            ]);
            $levelID->update($request->all());
            if($levelUpdated && $request->all() === 'canceled'){
                Session::flash('statuscode', 'success');
                return redirect()->route('levels.index')->with(['status'=>'nothing updateted']);
            }else{
                Session::flash('statuscode', 'success');
                return redirect()->route('levels.index')->with(['status'=>'Modification avec succés']);
            }


        }catch(\Exception $exception){
            return redirect()->route('levels.index')->with(['error'=>'There is a error :(']);
        }

    }

    public function destroy($id){
        //$levelName = Level::find($id);
        /*$id= Level::wherehas('classes', function($query) use($id){
            $query->where('id_level', '!=', $id);
        })->get();*/
        $id =Level::with('classes')->whereNotExists(function($query) use($id)
        {
            $query->select('id_level')
            ->from('Classerooms')
                ->where('id_level' ,'!=', $id)->orWhereNull('id_level');
        })->get();
        return $id;
       // $levelName->doesntHave('classes')->delete();
        //return ($levelName);
        Session::flash('statuscode', 'error');
       return redirect()->route('levels.index')->with('status','Level has been deleted');
    }
}
