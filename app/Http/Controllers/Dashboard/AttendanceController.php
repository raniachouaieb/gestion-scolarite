<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Level;
use App\Models\Module;
use App\Models\Schedule;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AttendanceController extends Controller
{
    public function index()
    {
        $date = date('d/m/Y');
        $niveaux = Level::orderBy('created_at', 'asc')->get();
        $breadcrumbs = [
            [
                'url' => route('attendance')
            ],
            [
                'class' => 'active'
            ],

        ];
        return view('dashboard.attendance.index', compact('breadcrumbs', 'niveaux', 'date'))->withTitle(__('Attendance'))->withName(__('Attendance'))->withNameBreadcrumbs(__("All"));
    }

    public function loadAttendance( $classroom_id = null,$trimester = null)
    {
        $date = date('Y-m-d');
        $students = Student::where("class_id", "=", $classroom_id)->get();

        $rows = Schedule::where('classroom_id', $classroom_id)->where('status', 1)->get();
        $output = [];
        $emploi_id=0;Log::info($rows);
        if(count($rows)==0){
            return ( "No Schedule for this level !");
        }
        foreach ($rows as $row) {

            $emploi_id = $row['id'];

            foreach (json_decode($row['monday'], true) as $seance) {
                if ($seance['date'] === $date) {
                    array_push($output, ["from" => $seance['from'], "to" => $seance['to']]);
                }
            }
            foreach (json_decode($row['tuesday'], true) as $tuesday) {
                    if ($tuesday['date'] === $date) {
                         array_push($output, ["from" => $tuesday['from'], "to" => $tuesday['to']]);                   }
                }
            }
        foreach (json_decode($row['wednesday'], true) as $wednesday) {
                     if ($wednesday['date'] === $date) {
                         array_push($output, ["from" => $wednesday['from'], "to" => $wednesday['to']]);
                     }
                 }

                 foreach (json_decode($row['thursday'], true) as $thursday) {
                     if ($thursday['date'] === $date) {
                         array_push($output, ["from" => $thursday['from'], "to" => $thursday['to']]);
                     }
                 }

                 foreach (json_decode($row['friday'], true) as $friday) {
                     if ($friday['date'] === $date) {
                         array_push($output, ["from" => $friday['from'], "to" => $friday['to']]);
                     }
                 }
                 foreach (json_decode($row['saturday'], true) as $saturday) {
                     if ($saturday['date'] === $date) {
                         array_push($output, ["from" => $saturday['from'], "to" => $saturday['to']]);
                     }
                 }


        $trimester = $trimester;
        $count=count($output);

        return view("dashboard.attendance.loadSchedule", compact( 'trimester','count','date', 'output', 'classroom_id', 'students', 'rows', 'emploi_id'))->render();

    }

    public function store(Request $request)
    {
        foreach ($request->get('student') as $student) {
            foreach ($student['status'] as $key => $status) {
              //  dd($status['raison']);
                $attendance = Attendance::create([
                    'status' => $status['etat'],
                    'date' => date('Y-m-d'),
                    'semester' => $request->trimestre,
                    'raison' => $status['raison'],
                    'emploi_id' => $request->emploi_id,
                    'heure_deb' => $status['from'],
                    'heure_fin' => $status['to'],
                    'student_id' => $student['student_id'],
                ]);
            }
        }
        return redirect()->back()->with('success', 'success');



    }


}
