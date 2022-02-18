<?php

namespace App\Http\Controllers\Dashboard;

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
        return view ('level.list', compact('levelName'));
    }

    public function addLevel(Request $request){
        //$levelName = Level::all();
        return view('level.create');
       
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
        return view('level.edit',compact('level'));
    }

    public function update(Request $request, $id){
        $level = Level::find($id);
        if(!$level){
            return redirect()->route('levels.index')->with(['error'=>'there is no data with this id, please enter a correct one']);
        }
        $level->level= $request->level;
        $level->save();
        return redirect('/admin/levels');

    }
    
    public function destroy($id){
        $levelName = Level::find($id);
        $levelName->delete();
        return redirect('/admin/levels')->with('success','Level has been deleted');
    }
}
