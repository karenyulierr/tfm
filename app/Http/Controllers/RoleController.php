<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Caffeinated\Shinobi\Models\Role;
//use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller{

    public function index(){
        $roles = Role::all();
        return response()->json($roles);
        //return view('roles.index', compact('roles'));
    }

    public function getAllPermission(){
        $roles = Permission:: orderBy('name', 'asc')->get();
        return response()->json($roles);

    }
    public function create(){
        $permissions = Permission::get();

        return view('roles.create', compact('permissions'));
    }


    public function store(Request $request){
        $exist = Role::select()->where('name', $request->name)->exists();
        if(!$exist){
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
            $response = $role_id;
        }else{
            $response = 'exist';
        }
        return response()->json($response);
    }

    public function getRoldId(Request $request){
            $role =
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
            $response = $role_id;



        return response()->json($response);
    }


    public function show($id){

    }


    public function edit(Role $role){
        $permissions = Permission::get();

        return view('roles.edit', compact('role', 'permissions'));
    }


    public function update(Request $request, $id){
        $role = Role::find($id);
        $permiso=Permission::where('name','=',$request->name)->first();

        if($request->status == 'inactivo'){
            $role->givePermissionTo($permiso);
        }else if($request->status == 'activo'){
            $role->revokePermissionTo($permiso);
        }
        $role = Role::where('id', $id)->update([
            'name' => $request->name_rol,
            'updated_at' => date('Y-m-d H:m:s')
        ]);
        return response()->json($role);
    }

    public function getPermissionsRole($id)
    {
        $query = Role::where('id', $id)->first();
        $permissions=DB::select('SELECT p.id, p.name, IF((rp.permission_id) IS NULL, "inactivo", "activo") AS status FROM permissions p LEFT JOIN (SELECT * FROM role_has_permissions WHERE role_id=?) AS rp ON rp.permission_id = p.id', [$id]);
        return response()->json([$permissions,$query]);
    }
    public function destroy($id){

    }
    public function putRole(Request $request, $id) {
        $role = DB::table('roles')->where('id', $id)->update([
            'name' => $request->name,
            'updated_at' => date('Y-m-d H:m:s')
        ]);
        return response()->json($role);
    }
}
