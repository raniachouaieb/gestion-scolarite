<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->except('logout');
    }

    public function logout(Request $request) {

        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function index()
    {
        return view('dashboard.admin.home');
    }
}
