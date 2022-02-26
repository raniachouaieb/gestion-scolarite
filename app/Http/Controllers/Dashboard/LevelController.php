<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\LevelRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Level;
use Illuminate\Support\Facades\Validator;

class LevelController extends Controller
{

  public function __construct(){
     $this -> middleware('auth:admin');
  }

    public function index(){
        
        $levelName = Level::all();
        //return $levelName;
        return view ('dashboard.level.list', compact('levelName'))->withTitle('Liste des niveaux');
    }

    public function addLevel(Request $request){
        //$levelName = Level::all();
        return view('dashboard.level.create');
       
        }
       


    public function store(Request $request)
    {
        $levelName = new Level();
        $levelName->level= $request->level;
      
        $levelName->save();
        
        
        return redirect('admin/levels')->with('success','Level has been added');
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
        return redirect()->route('levels.index')->with('success','Level has been modified successfully');

    }
    
    public function destroy($id){
        $levelName = Level::find($id);
        $levelName->delete();
        return redirect()->route('levels.index')->with('success','Level has been deleted');
    }
}
