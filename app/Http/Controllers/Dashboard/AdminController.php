<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\UserRequest;
use App\Models\Admin;
use App\Models\Classroom;
use App\Models\Convocation;
use App\Models\Info;
use App\Models\Matiere;
use App\Models\Parente;
use App\Models\Student;
use App\Models\Travail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
        $convocations = Convocation::get();
        //$informations = Info::get();
        $matieres = Matiere::get();
        $tasks  = Travail::orderBy('created_at', 'desc')->take(5)->get();
        $classes = Classroom::get();
        $informations = Info::orderBy('created_at', 'desc')->take(5)->get();
        $fille_records = Student::whereNotNull('class_id')->where('gender', 1)->count();
        $garcon_records = Student::whereNotNull('class_id')->where('gender', 0)->count();
       // dd($fille_records, $garcon_records );
        return view('dashboard.admin.home', compact('matieres','tasks','classes','parentPréinscrit', 'elevePréinscrit', 'parentInscrit', 'eleveInscrit', 'convocations','informations', 'garcon_records', 'fille_records'));
    }

    public function list(Request $request)
    {
        $admin = Admin::orderBy('id')->paginate(PAGINATION);
        $role = Role::get();
        return view('dashboard.users.list_users',compact('admin','role'))->withTitle('liste des utilisateurs');

    }

    public function add()
    {
        //$roles = Role::pluck('name','name')->all();

        $roles = Role::all();
        return view('dashboard.users.create', compact('roles'))->withTitle('Ajouter utilisateur');
    }

    public function storeUser(UserRequest $request)
    {

        $user = new Admin();
        $user->name= $request->name;
        $user->email= $request->email;
        $user->status=isset($request->status) ? 1 : 0;
        $user->password=$request->password;
        $user->roles_name=$request->role;
        if($request->has('image')){
           // dd($request->input('image'));
            $path = uploadImage('admin',$request->image);
            //return $path;
            $user->image = $path;
        }
        $user->assignRole($request->input('role'));
        Admin::sendPasswordEmail($user);
        $user->save();

        Session::flash('statuscode', 'success');
        return redirect()->route('admins')->with('status','utilisateur est ajoutée avec ucces');


    }
    public function edit($id)
    {
        $user = Admin::find($id);
        $roles = Role::get();
        //$roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name')->all();
        return view('dashboard.users.edit',compact('user','roles','userRole'))->withTitle('Modifier utilisateur');
    }

    public function update( Request $request, $id){
        $userID = Admin::find($id);
        try{
            if(!$userID){
                return redirect()->route('admins')->with(['error'=>'there is no data with this id, please enter a correct one']);
            }
            $userID->name= $request->name;
            $userID->email=$request->email;
            $userID->status=isset($request->status) ? 1 : 0;
            $userID->password=$request->password;
            $userID->roles_name=$request->role;

            if($request->hasfile('image')){

                $path = uploadImage('admin',$request->file('image'));
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $userID->image= $path;
            }
            $userID->update();
            $userID->assignRole($request->input('role'));
            Admin::sendPasswordEmail($userID);

                Session::flash('statuscode', 'success');
                return redirect()->route('admins')->with(['status'=>'Modification avec succés']);



        }catch(\Exception $exception){
            //return $exception;
            Session::flash('statuscode', 'success');

            return redirect()->route('admins')->with(['status'=>'There is a error :(']);
        }


    }

    public function destroy($id){
        $user = Admin::find($id);
        $user->delete();

        Session::flash('statuscode', 'error');
        return redirect()->route('admins')->with('status','Cet utilisateur est supprimé');
    }

    public function profile($id){
        $user = Auth::guard('admin')->user()->find($id);
        return view('dashboard.users.profile', compact('user'))->withTitle('Profile');
    }

    public function updateImg(Request $request, $id){
        try{
            $user = Auth::guard('admin')->user()->find($id);

            if($request->hasfile('image')){

                $path = uploadImage('admin',$request->image);
              //  return $path;
                if(File::exists($path))
                {
                    File::delete($path);
                }

                $user->image= $path;
            }
            $profile =$user->update();

            if($profile){
                Session::flash('statuscode', 'success');
                return view('dashboard.users.profile', compact('user'))->with('status', 'image changée avec succée')->withTitle('profile');

            }else{
                Session::flash('statuscode', 'error');
                return view('dashboard.users.profile')->with('status', 'error')->withTitle('profile');
            }

        }catch(\Exception $ex){
            return $ex;
            Session::flash('statuscode', 'error');

            return view('dashboard.users.profile')->with('status', 'error')->withTitle('profile');

        }


    }

    public function changeStatus( $id, Request $request)
    {
        try {
            //$getStatus= Admin::select('status')->where('id', $id)->first();
            $admin = Admin::paginate(PAGINATION);;
            $role = Role::get();
            $getStatus = Admin::select('status')->find($id);
            //dd($getStatus);
            //return $getStatus;
            if($getStatus->status == 'Active'){
                $getStatus::where('id', $id)->update(['status'=>0]);
            }else{
                $getStatus::where('id', $id)->update(['status'=>1]);
            }
            Session::flash('statuscode', 'succes');
            return redirect()->route('admins')->with(['status'=>'changed'])->withTitle('list users');;
            //return view('dashboard.admin.home',compact('admin','role'))->with(['status'=>'changed'])->withTitle('list users');
            //return $getStatus;
        }catch (\Exception $exception){
            //return $exception;
            //return view('dashboard.users.list_users',compact('admin','role'))->with(['status'=>'No'])->withTitle('list users');
        }

    }

}
