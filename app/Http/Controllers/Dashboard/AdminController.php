<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Parente;
use App\Models\Student;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->except('logout');
    }

    public function logout() {

        Auth::guard('admin')->logout();
        Session::flash('statuscode', 'success');
        return redirect()->route('admin.login')->with('status', 'Logout successfully');
    }

    public function index()
    {
        $parentPréinscrit = Parente::where('is_active',0)->get();
        $parentInscrit = Parente::where('is_active',1)->get();

        $elevePréinscrit = Student::whereNull('class_id')->get();
        $eleveInscrit = Student::whereNotNull('class_id')->get();

        return view('dashboard.admin.home', compact('parentPréinscrit', 'elevePréinscrit', 'parentInscrit', 'eleveInscrit'));
    }


}
