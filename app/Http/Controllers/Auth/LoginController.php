<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function username(){


        $value= request()->input('identifiant');
        //dd($valuePass);

        $field = filter_var($value, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        request()->merge([$field=>$value]);
        return $field;

      /*  if (Auth::attempt([$field=>$value]))
        {

         return redirect()->route('home')->with('success','Welcome!');

       }
        return redirect()->back()->with('error', 'oups');*/

    }
}
