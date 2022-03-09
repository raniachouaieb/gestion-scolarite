<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ParentRequest;
use App\Http\Requests\StudentRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Parente;
use App\Models\Student;

use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        $login = $request->validate([
            'email'=>'required|string',
            'password'=>'required'

        ]);
        $parent = Parente::where('email', $request->email)->first();
        try{
        if ($parent || Hash::check($request->password, $parent->password)){
            $accessToken = $parent->createToken('Auth Token')->accessToken;
            return response([ 'parent'=> $parent, 'access_token' => $accessToken]);
        }
    }catch(\Exception $exception){
        return response()->json([
            'message'=>'Invalid email/password']);

        }
       
  
    }

    public function register(ParentRequest $request, StudentRequest $requestStd){
        try{
       $parent = Parente::create([
            "nomPere"=>$request->nomPere,
            "prenomPere"=>$request->prenomPere,
            "professionPere"=>$request->professionPere,
            "telPere"=>$request->telPere,
            "nomMere"=>$request->nomMere,
            "prenomMere"=>$request->prenomMere,
            "professionMere"=>$request->professionMere,
            "telMere"=>$request->telMere,
            "nbEnfants"=>$request->nbEnfants,
            "adresse"=>$request->adresse,
            "email"=>$request->email,
            'password' => Hash::make($request->password),

      ]);

           Student::create([
            "nomEleve"=>$requestStd->nomEleve,
            "prenomEleve"=>$requestStd->prenomEleve,
            "niveau"=>$requestStd->niveau,
            "gender"=>$requestStd->gender,
            "parent_id"=>$parent->id,
        ]);
     
        return response()->json(['message'=> 'Successfully created']);
    }catch(\Exception $exception){
        return response([
            'message'=>$exception->getMessage()
        ]);
    }

      


    }

    public function logout(ParentRequest $request){
        $request->user()->token()->revoke();
        return response()->json([
            'message'=>'Successfully logged out'
        ]);
    }
}  

