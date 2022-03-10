<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use function view;
use Illuminate\Support\Facades\Auth;


class HomeParentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
     {
         $this->middleware(['auth:parente', 'verified']);
     }

     /**
      * Show the application dashboard.
      *
      * @return \Illuminate\Contracts\Support\Renderable
      */
    public function index()
    {
        //return 'test';
        if(Auth::guard('parente')->user()->email_verified_at === Null){
            //Session::flash('statuscode', 'error');
            return view('auth.login')->with('error', ' your email is not yet verified! please check your email');
        }
        return view('frontParent.home-parent')->with('success', ' Your email is verified successfully');
    }
}
