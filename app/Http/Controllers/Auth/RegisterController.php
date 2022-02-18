<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:pareents'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Parent
     */
    protected function create(array $data)
    {
        return Parent::create([
            //'name' => $data['name'],
            'nom Pere' => $data['nomPere'],
            'prenom Pere' => $data['prenomPere'],
            'tel Pere' => $data['telPere'],
            'profession Pere' => $data['professionPere'],
            'nom Mere' => $data['nomMere'],
            'prenom Mere' => $data['prenomMere'],
            'tel Mere' => $data['telMere'],
            'profession Mere' => $data['professionMere'],
            'nb enfants' => $data['nbEnfants'],

            
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
