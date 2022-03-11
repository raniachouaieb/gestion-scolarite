<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Session;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->except('logout');
    }

    public function logout(Request $request) {

        Auth::guard('admin')->logout();
        Session::flash('statuscode', 'success');
        return redirect()->route('admin.login')->with('status', 'Logout successfully');
    }

    public function index()
    {
        return view('dashboard.admin.home');
    }
}
