<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Validation\ValidationException;
use Session;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('showLoginForm');
    }

    public function showLoginForm(){
        return view('dashboard.admin.login');
    }

    public function getLogin(LoginRequest  $request){

        //return view('dashboard.admin.home');
        $remember = $request->has('remember_me')? true : false ;

      if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $remember))
       {
           Session::flash('statuscode', 'success');
        return redirect()->route('homeg')->with('status','Welcome!');

      }

       return redirect()->back()->with('error', 'oups! Invalid email or password, Please verify');


    }




    /*public function username(){
        $value = request()->input('identify'); //get the input value
        $field= filter_var($value, FILTER_VALIDATE_EMAIL)? 'email':'name';
        request()->merge([$field=>$value]);
        return $field;

    }*/
}
