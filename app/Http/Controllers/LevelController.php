<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function addLevel(Request $request){
        $levelName = new Level;
        $levelName->level= $request->level;
      
        $levelName->save();
        return response()->json($levelName);
        }
       


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'level' => 'required',
        ]);

        // The blog post is valid...
    }
}
