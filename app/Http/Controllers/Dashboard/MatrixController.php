<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\ClassroomRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Classroom;
use App\Models\Level;
use DB;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class MatrixController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $roles = Role::select('id', 'name')->get();
        $permissions= Permission::get();
        $rolePermissions = DB::table('role_has_permissions')->where('role_has_permissions.role_id',$roles)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('dashboard.matrix.list', compact('roles', 'permissions', 'rolePermissions'))->withTitle('Matrix');

    }
}
