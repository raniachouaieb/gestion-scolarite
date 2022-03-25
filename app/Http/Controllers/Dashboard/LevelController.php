<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\LevelRequest;
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
        $level = Level::find($id);
        if(!$level){
            return redirect()->route('levels.index')->with(['error'=>'Oups! there is no data with this id, please enter a correct one']);
        }
        $level->level= $request->level;
        $level->save();

        Session::flash('statuscode', 'info');
        return redirect()->route('levels.index')->with('status','Level has been modified successfully');

    }

    public function destroy($id){
        $levelName = Level::find($id);
        $levelName->delete();
        //return view('dashboard.modals.delete-level');

        Session::flash('statuscode', 'error');
       return redirect()->route('levels.index')->with('status','Level has been deleted');
    }
}
