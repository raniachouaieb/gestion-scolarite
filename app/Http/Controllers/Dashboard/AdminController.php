<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class AdminController extends Controller
{
  

   
    public function index()
    {
        return view('dashboard.admin.home');
    }
}