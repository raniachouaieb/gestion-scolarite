<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Parente;
use App\Models\Student;
use App\Models\Classroom;
use App\Models\Level;


use DB;

class StudentController extends Controller
{
    public function __construct(){
        $this -> middleware('auth:admin');
     }
   
       public function index(){
        $student = Student::get();
       
           return view('dashboard.students.list-student',compact('student'));
           
       }
    }
