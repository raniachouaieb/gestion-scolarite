<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ParentRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


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
        //$this->middleware('auth:parente')->except('logout');
    }

    public function getLogin(){
        return view('auth.login');
    }

    public function login(LoginRequest   $request){


        if (Auth::guard('parente')->attempt(['email' => $request->email, 'password' => $request->password]))
        {


            return redirect()->route('parentHome')->with('
            success', 'Your email is verified successfully! you can now');

        }

        return redirect()->route('getLogin')->with('error', ' Invalid email or password, Please verify');


        /*$value= request()->input('identifiant');
        //dd($valuePass);

        $field = filter_var($value, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        request()->merge([$field=>$value]);
        return $field;*/

      /*  if (Auth::attempt([$field=>$value]))
        {

         return redirect()->route('home')->with('success','Welcome!');

       }
        return redirect()->back()->with('error', 'oups');*/

    }

    public function forgot(){
        return view('auth.passwords.reset');
    }
}
