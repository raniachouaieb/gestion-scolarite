<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Level;

class LevelController extends Controller
{

  public function __construct(){
     $this -> middleware('auth:admin');
  }

    public function index(){
        
        $levelName = Level::all();
        //return $levelName;
        return view ('classroom.list', compact('levelName'));
    }

    public function addLevel(Request $request){
        //$levelName = Level::all();
        return view('classroom.create');
       
        }
       


    public function store(Request $request)
    {
        $levelName = new Level();
        $levelName->level= $request->input('level');
      
        $levelName->save();
        return response()->json($levelName);

    
    }

    public function show($id){
        $levelName = Level::find($id);
        return response()->json($levelName);

    }

    public function update(Request $request, $id){
        $levelName = Level::find($id);
        $levelName->level= $request->input('level');
        $levelName->save();
        return redirect('/');

    }
    
    public function destroy($id){
        $levelName = Level::find($id);
        $levelName.delete();
        return redirect('/');
    }
}
