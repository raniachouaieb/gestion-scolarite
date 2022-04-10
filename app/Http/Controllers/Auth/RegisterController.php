<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Parente;
use App\Models\Student;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ParentRequest;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

   protected function validator(array $data)
    {
        return Validator::make($data, [
          'nomPere' => ['required', 'string', 'max:255'],
          'prenomPere' => ['required', 'string', 'max:255'],
          'telPere' => ['required', 'max:8'],
          'professionPere' => ['required', 'string', 'max:255'],
          'nomMere' => ['required', 'string', 'max:255'],
          'prenomMere' => ['required', 'string', 'max:255'],
          'telMere' => ['required', 'max:8'],
          'professionMere' => ['required', 'string', 'max:255'],
          'nbEnfants' => ['required'],
          'adresse' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:pareents'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }



    public function create(Request $request)
    {
        //dd($request);

        return Parente::create([
            //'name' => $data['name'],
            'nomPere' => $request['nomPere'],
            'prenomPere' => $request['prenomPere'],
            'telPere' => $request['telPere'],
            'professionPere' => $request['professionPere'],
            'nomMere' => $request['nomMere'],
            'prenomMere' => $request['prenomMere'],
            'telMere' => $request['telMere'],
            'professionMere' => $request['professionMere'],
            'nbEnfants' => $request['nbEnfants'],
            'adresse' => $request['adresse'],


            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
    }
    public function getRegister(){
        return view('auth.register');
    }




}
