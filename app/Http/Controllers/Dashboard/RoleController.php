<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
class RoleController extends Controller
{
    function __construct()
    {

    }
    public function index()
    {
        $roles = Role::orderBy('id')->get();
        return view('dashboard.roles.index',compact('roles'))->withTitle('liste des rôles')
            ;

    }
    public function add()
    {
        $permission = Permission::get();
        return view('dashboard.roles.create',compact('permission'))->withTitle('Créer rôle');
    }

    public function store(Request $request)
    {

        try{
            $role = new Role();
            $role->name= $request->role;
            $role->syncPermissions($request->input('permission'));
            $role->save();

            Session::flash('statuscode', 'success');

            return redirect()->route('list')
                ->with('status','Role created successfully');
        }catch(\Exception $ex){
            return $ex;
            Session::flash('statuscode', 'error');
            return redirect()->route('list')
                ->with(['status'=>'Error']);
        }

}


}
