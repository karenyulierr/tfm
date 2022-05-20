<?php

namespace App\Http\Controllers;

use Auth;
use App\ModelHasRole;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = auth()->user()->roles;
        $role_id =  $roles[0]->id;
        if($role_id == 1){
            $query = Role::all();
        }else{
            $query = Role::where('id', '<>', 1)->get();
        }
        return response()->json($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role_id=Role::create([
            'name' => $request->name,
            'guard_name' => 'web'
        ])->id;

        $permisos = $request->permissions;
        //Asigna los permisos al usuario
        $role = Role::find($role_id);
        for($i = 0; $i < count($permisos); $i++){
            $role->givePermissionTo($permisos[$i]);
        }

        return response()->json($role_id);
    }

    public function getAllPermission() {
        return DB::table('permissions')->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permissions=DB::select('SELECT p.id, p.name, IF((rp.permission_id) IS NULL, "inactivo", "activo") AS status FROM permissions p LEFT JOIN (SELECT * FROM role_has_permissions WHERE role_id=?) AS rp ON rp.permission_id = p.id', [$id]);
        return response()->json($permissions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $permiso=Permission::where('name','=',$request->name)->first();

        if($request->status == 'inactivo'){
            $role->givePermissionTo($permiso);
        }else if($request->status == 'activo'){
            $role->revokePermissionTo($permiso);
        }
        return response()->json($role);
    }

    //Consulta el rol por id
    public function getRolId($id) {
        $query = Role::where('id', $id)->get();
        return response()->json($query);
    }

    public function putRole(Request $request, $id) {
        $role = DB::table('roles')->where('id', $id)->update([
            'name' => $request->name,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);
        return response()->json($role);
    }

    public function getUserPermission($id)
    {
        $role=ModelHasRole::select('role_id')->where('model_id', $id)->first();
        $permissions=DB::select('SELECT p.id, p.name, IF((rp.permission_id) IS NULL, "inactivo", "activo") AS role_status, IF((mp.permission_id) IS NULL, "inactivo", "activo") AS user_status FROM permissions p LEFT JOIN (SELECT * FROM role_has_permissions WHERE role_id=?) AS rp ON rp.permission_id = p.id LEFT JOIN (SELECT * FROM model_has_permissions WHERE model_id=?) AS mp ON mp.permission_id = p.id', [$role->role_id,$id]);
        return response()->json($permissions);
    }
    public function updateUserPermission(Request $request, $id)
    {
        $user=User::find($id);
        $role=ModelHasRole::select('role_id')->where('model_id', $id)->first();
        $permission=Permission::where('name','=',$request->name)->first();

        if($request->status == 'inactivo'){
            $user->givePermissionTo($permission);
        }else if($request->status == 'activo'){
            $user->revokePermissionTo($permission);
        }
        return response()->json($user);
    }
}
