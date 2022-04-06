<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
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

    public function store(RoleRequest $request)
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

    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table('role_has_permissions')->where('role_has_permissions.role_id',$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('dashboard.roles.edit',compact('role','permission','rolePermissions'))->withTitle('Modifier rôle');
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        try{
            if(!$role){
                return redirect()->route('list')->with(['error'=>'there is no data with this id, please enter a correct one']);
            }
            $permUpdated = $role->update([
                'name'=>$request->role,

            ]);
            $role->syncPermissions($request->input('permission'));

            $role->update($request->all());


                Session::flash('statuscode', 'success');
                return redirect()->route('list')->with(['status'=>'Role updated successfully']);



        }catch(\Exception $exception){
            return redirect()->route('list')->with(['error'=>'There is a error :(']);
        }



    }
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();

        Session::flash('statuscode', 'error');
        return redirect()->route('list')->with('status','rôle est supprimée');


}


}
