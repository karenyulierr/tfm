<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\App;
use PhpParser\Comment\Doc;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Notification;

class UserController extends Controller
{
    public function index() {
        DB::statement('SET @REG=0');
        $query = User::join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->select(
                'users.name as name',
                'users.identification as identification',
                'users.email as username',
                'roles.name as rol',
                'users.id as options',
                'users.deleted_at as status',
                DB::raw('(@REG:=@REG+1) as cont')
            )->withTrashed()->get();
        return response()->json($query);
    }

    public function show($id) {
        $extract_id = explode('-', $id);
        if($extract_id[1] == 'identification') {
           $query = User::where('identification', $extract_id[0])->exists();
        }else if($extract_id[1] == 'email') {
            //$query = User::where('email', $extract_id[0])->first();
            $query = User::where('email', $extract_id[0])->withTrashed()->get();
        }
        return response()->json($query);
    }

    public function store(Request $request) {

        $user = User::create([
            'name' => $request->name,
            'identification' => $request->identification,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        // Asignación del rol
        $user->assignRole($request->role_id);



        //$this->sendMailUser($user->id, $request->password);

        return response()->json($user->id);
    }

    public function edit($id) {
        $user = User::where('id', $id)->first();
        $role = DB::table('model_has_roles')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('model_has_roles.model_id', $id)
            ->select('roles.name', 'roles.id')->first();
        return response()->json(['users' => $user, 'role' => $role]);
    }

    public function update(Request $request, $id) {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password!=''){
            $user->password = bcrypt($request->password);
        }

        $user->save();

//         Asignación del rol
        DB::table('model_has_roles')->where('model_id', $id)->update([
            'role_id' => $request->role_id
        ]);

        return response()->json($user);
    }

    public function addPermission(Request $request) {
        $datos = $request->datos;
        for ($i = 0; $i < count($datos); $i++){
            $field=FieldPermission::updateOrCreate(
                [
                    'user_id' => $datos[$i]['user_id'],
                    'field_id' => $datos[$i]['field_id'],
                ],
                [
                    'state'=> 'active',
                    'user_register_id' => Auth::user()->id,
                ]
            );
            $zone=ZonePermission::updateOrCreate(
                [
                    'user_id' => $datos[$i]['user_id'],
                    'zone_id' => $datos[$i]['zone_id'],
                ],
                [
                    'state'=> 'active',
                    'user_register_id' => Auth::user()->id,
                ]
            );
            $project=ProjectPermission::updateOrCreate(
                [
                    'user_id' => $datos[$i]['user_id'],
                    'project_id' => $datos[$i]['project_id'],
                ],
                [
                    'state'=> 'active',
                    'user_register_id' => Auth::user()->id,
                ]
            );
            $project=EnterprisePermission::updateOrCreate(
                [
                    'user_id' => $datos[$i]['user_id'],
                    'enterprise_id' => $datos[$i]['enterprise_id'],
                ],
                [
                    'state'=> 'active',
                    'user_register_id' => Auth::user()->id,
                ]
            );
            $project=CountryPermission::updateOrCreate(
                [
                    'user_id' => $datos[$i]['user_id'],
                    'country_id' => $datos[$i]['country_id'],
                ],
                [
                    'state'=> 'active',
                    'user_register_id' => Auth::user()->id,
                ]
            );
        }
        return response()->json($project);
    }

    public function getPermissionProjects($id) {
        $response = DB::table('field_permissions')
        ->join('fields', 'fields.id', '=', 'field_permissions.field_id')
            ->select('field_permissions.id', 'fields.name')
            ->where([['field_permissions.user_id', $id],['field_permissions.state','active']])->get();
        return response()->json($response);
    }

    public function deletePermissionProject($id) {
        $result = DB::table('field_permissions')->where('id', $id)->update([
            'state' => 'inactive'
        ]);
        return response()->json($result);
    }

    public function getTrainingsUser($id) {
        DB::statement('SET @REG=0');
        $query = DB::table('training_permissions')
            ->join('trainings', 'trainings.id', '=', 'training_permissions.training_id')
            ->select('trainings.id as training_id', 'trainings.name', 'training_permissions.id as options', DB::raw('(@REG:=@REG+1) as cont'))
            ->where('training_permissions.user_id', $id)->get();
        return response()->json($query);
    }

    public function setTrainingUser(Request $request) {
        $trainings = $request->trainings;
        $result = [];
        for($i=0; $i<count($trainings); $i++) {
            $verifyTraining = DB::table('training_permissions')->where([
                ['training_id', $trainings[$i]['id']],
                ['user_register_id', Auth::user()->id],
            ])->exists();
            if($verifyTraining){
                array_push($result, $trainings[$i]['name']);
            }else {
                $id=DB::table('training_permissions')->insertGetId([
                    'user_id' => $request->user_id,
                    'training_id' => $trainings[$i]['id'],
                    'user_register_id' => Auth::user()->id,
                    'state' => 1,
                    'created_at' => date('Y-m-d H:m:s'),
                    'updated_at' => date('Y-m-d H:m:s')
                ]);
                array_push($result, $id);
            }
        }
        return response()->json($result);
    }

    public function getAccessesUser($id) {
        DB::statement('SET @REG=0');
        $query = DB::table('access_histories')->where('user_id', $id)
            ->select(DB::raw('(@REG:=@REG+1) as cont'), 'access_histories.id', 'access_histories.browser', 'access_histories.ip', 'access_histories.created_at')->get();
        return response()->json($query);
    }

    //elimina permisos de capacitaciones del usuari
    public function deleteTrainingUser($id)
    {
        $query = DB::table('training_permissions')->where('id', $id)->delete();
        return response()->json($query);
    }

    //Envia correo a usuario con datos de acceso al sistema
    public function sendMailUser($id,$password)
    {
        $datos = User::join('detail_users','users.id','=','detail_users.user_id')
            ->where('users.id',$id)
            ->select('users.id','users.name','users.email','users.password','detail_users.identification')
            ->get();

        $users= [];
        $details = [
            'cc' => '',
            'subject' => 'Datos de acceso a la plataforma - '.$datos[0]->name.' '.$datos[0]->identification,
            'greeting' => 'Bienvenido al portal médico de Salud Ocupacional Empresarial',
            'body' => 'A continuación se le proporciona la información necesaria para ingresar al sistema: ',
            'text' => 'URL: '.url('').' - Usuario: '.$datos[0]->email.' - Contraseña: '.$password,
            'attach' => false,
        ];

        $users_cc = array();
        $i = 0;
        if(sizeof($users) > 1){
            foreach ($users as $user){
                if($i > 0){
                    array_push($users_cc,$user->email);
                }
                $i++;
            }
        }
        $details['cc'] = $users_cc;

        $user = User::where('id',$datos[0]->id)->get();

       Notification::send($user, new ExamRequest($details));
        //return response()->json($response);
    }
    public function getDetailUser()
    {
        $query = DetailUser::join('users', 'detail_users.user_id', '=', 'users.id')
            ->select('detail_users.identification')->where('users.email',$_GET['email'])->first();

        $password = $_GET['password'];
        $validation = str_contains($password, $query->identification);

        if ($validation){
            $response['state']  = true;
        }else{
            $response['state']  = false;
        }

        return response()->json($response);
    }
    public function getFields()
    {
        $response = Field::where('state','active')->get();
        return response()->json($response);
    }
    public function getIdPermission($id)
    {
        $response = Field::join('projects', 'projects.id', '=', 'fields.project_id')
            ->join('zones', 'projects.zone_id', '=', 'zones.id')
            ->join('enterprises', 'zones.enterprise_id', '=', 'enterprises.id')
            ->join('countries', 'enterprises.country_id', '=', 'countries.id')
            ->select('projects.id as project_id','zones.id as zone_id','enterprises.id as enterprise_id','countries.id as country_id','fields.id as field_id')
            ->where('fields.id',$id)->get();
        return response()->json($response);
    }
    public function getPermissionIps($id) {
        $response = DB::table('ips_branch_permissions')
            ->join('ips_branches', 'ips_branches.id', '=', 'ips_branch_permissions.ips_branch_id')
            ->select('ips_branch_permissions.id', 'ips_branches.name')
            ->where([['ips_branch_permissions.user_id', $id],['ips_branch_permissions.state','active']])->get();
        return response()->json($response);
    }
    public function getIps()
    {
        $response = IpsBranch::where('state','active')->get();
        return response()->json($response);
    }
    public function addIps(Request $request) {
        $ips = $request->ips;
        for ($i = 0; $i < count($ips); $i++){
            $response=IpsBranchPermission::updateOrCreate(
                [
                    'user_id' => $ips[$i]['user_id'],
                    'ips_branch_id' => $ips[$i]['id'],
                ],
                [
                    'state'=> 'active',
                    'user_register_id' => Auth::user()->id,
                ]
            );
        }
        return response()->json($response);
    }
    public function deletePermissionIps($id) {
        $result = DB::table('ips_branch_permissions')->where('id', $id)->update([
            'state' => 'inactive'
        ]);
        return response()->json($result);
    }

    public function updateStateUser(Request $request) {

        $user = User::withTrashed()->where('id',$request->id)->first();
        $state = '';
        if($request->state == 'activo'){
            $state = 'inactivo';
            $user->delete();

        }else{
            $state = 'activo';
            $user->restore();

        }

        return response()->json($state);
    }

}
