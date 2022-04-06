<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\UserRequest;
use App\Models\Admin;
use App\Models\Convocation;
use App\Models\Parente;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
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

        return view('dashboard.admin.home', compact('parentPréinscrit', 'elevePréinscrit', 'parentInscrit', 'eleveInscrit', 'convocations'));
    }

    public function list(Request $request)
    {
        $data = Admin::orderBy('id')->paginate(5);
        $role = Role::get();
        return view('dashboard.users.list_users',compact('data','role'))->withTitle('liste des utilisateurs');

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
        $user->status=$request->status == 'true' ? 1 : 0;
        $user->password=Hash::make($request->password);
        $user->roles_name=$request->role;
        $user->assignRole($request->input('role'));
        $user->save();
        Session::flash('statuscode', 'success');
        return redirect()->route('admins')->with('status','utilisateur est ajoutée avec ucces');


    }
    public function edit($id)
    {
        $user = Admin::find($id);
        $roles = Role::get();
        //$roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('dashboard.users.edit',compact('user','roles','userRole'))->withTitle('Modifier utilisateur');
    }

    public function update( Request $request, $id){
        $userID = Admin::find($id);
        try{
            if(!$userID){
                return redirect()->route('admins')->with(['error'=>'there is no data with this id, please enter a correct one']);
            }
            $userUpdated = $userID->update([
                'name'=>$request->name,
                "email"=>$request->email,
                "status"=>($request->status == 'false')? 0:1,

            "roles_name"=>$request->role,
            ]);
            $userID->assignRole($request->input('role'));
            if(!empty($userID['password'])){
                $userID['password'] = Hash::make($userID['password']);
            }
            $userID->update($request->all());
            if($userUpdated && $request->all() === 'canceled'){
                Session::flash('statuscode', 'success');
                return redirect()->route('admins')->with(['status'=>'nothing updated']);
            }else{
                Session::flash('statuscode', 'success');
                return redirect()->route('admins')->with(['status'=>'Modification avec succés']);
            }


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



}
