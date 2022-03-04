<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

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

    public function guard(){
        return Auth::guard('admin');
    }

    public function getLogin(LoginRequest $request){
        
        //return view('dashboard.admin.home');

      if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]))
       {
      
        return redirect()->route('admin.getLogin')->with('success','Welcome!');
           
      }
       return redirect()->back()->with('error', 'oups');
       

    }

    /*public function username(){
        $value = request()->input('identify'); //get the input value
        $field= filter_var($value, FILTER_VALIDATE_EMAIL)? 'email':'name';
        request()->merge([$field=>$value]);
        return $field;

    }*/
}
