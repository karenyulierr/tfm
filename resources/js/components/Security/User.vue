<template>
    <div>
        <div class="page-inner">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header" style="background: #E7E7E7">
                            <div class="card-title">
                                <template v-if="formCreate">
                                    <div class="pull-right">
                                        <button class="btn"  @click="eventButton(false)">Regresar <i class="fa fa-arrow-left"></i></button>
                                    </div>
                                    <h2 class="clr-font"><b>Registrar usuario</b></h2>
                                </template>
                                <template v-else>
                                    <div class="pull-right">
                                        <button class="btn " @click="eventButton(true)">Nuevo <i class="fa fa-plus"></i></button>
                                    </div>
                                    <h2 class="clr-font"><b>Listado de usuarios</b></h2>
                                </template>
                            </div>
                        </div>
                        <div class="card-body">
                            <!--         REGISTRO DE USUARIOS                   -->
                            <template v-if="formCreate">
                                <form method="POST" id="form-set-user" autocomplete="off" @submit.prevent="setUser">
                                    <div class="row">
                                        <div class="col">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="identification" class="control-label">Identificación: </label>
                                                    <input type="number" id="identification" v-model="identification" class="form-control" @blur="verifyDataUser('identification')" required>
                                                    <span v-if="loadIdentification"><i class="fa fa-spinner fa-spin"></i> Validando cédula</span>
                                                    <span v-else></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="email" class="control-label">Correo
                                                        electrónico: </label>
                                                    <input type="email" id="email" v-model="email" class="form-control" @blur="verifyDataUser('email')" required>
                                                    <span v-if="loadEmail"><i class="fa fa-spinner fa-spin"></i> Validando correo</span>
                                                    <span v-else></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="password" class="control-label">Password: </label>
                                                    <input type="text" v-model="password" class="form-control" required>
                                                </div>
                                            </div>
                                            <template v-if="rol_id=='Medico IPS' || rol_id=='Profesional paraclinicos' ">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="name" class="control-label">Licencia ocupacional: </label>
                                                        <input type="text" v-model="occupational_license" class="form-control" >
                                                    </div>
                                                </div>
                                            </template>
                                            <div class="col-md-12 mt-3">
                                                <template v-if="loadSave">
                                                    <div class="form-group">
                                                        <h4><i class="fa fa-spinner fa-spin"></i> Guardando datos..</h4>
                                                    </div>
                                                </template>
                                                <template v-else>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn" ><i class="fa fa-save"></i> Guardar</button>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="name" class="control-label">Nombres completos: </label>
                                                    <input type="text" id="name" v-model="names" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12" hidden>
                                                <div class="form-group">
                                                    <label for="name" class="control-label">Contraseña: </label>
                                                    <input type="text" id="password" v-model="password" class="form-control" required readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="rol" class="control-label">Rol: </label>
                                                    <select id="rol" class="custom-select" v-model="rol_id" required>
                                                        <option value="0">Seleccionar rol</option>
                                                        <option v-for="data in roles" :value="data.name" v-text="data.name"></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </template>
                            <!--        LISTADO DE USUARIOS                    -->
                            <div class="row" v-else>
                                <div class="table-responsive">
                                    <vue-bootstrap4-table :rows="rows" :columns="columns" :config="config" :classes="classes">
                                        <template slot="empty-results">
                                            No se encontraron registros!
                                        </template>

                                        <template slot="options" slot-scope="props">
                                            <div class="dropdown">
                                                <button class="btn btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #6c757d">
                                                    <i class="fas fa-tool"></i> Ver opciones
                                                </button>
                                                <div>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <a class="dropdown-item" href="#" v-on:click="showUser(props.cell_value.id)"><i class="fas fa-edit"></i>  Editar</a>
                                                        <a class="dropdown-item" href="#" v-on:click="getPermissions(props.cell_value.id)" data-toggle="modal" data-target="#ModalSystemPermission"><i class="fas fa-lock"></i> Permisos</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                        <template slot="status" slot-scope="props">
                                            <div class="switch">
                                                <label v-if="props.cell_value.status == 'activo'">
                                                    <input type="checkbox" v-model="checkboxes[props.row.vbt_id-1]" v-on:change="updateState(props.cell_value, props.row.vbt_id-1)" name="check-button" checked>
                                                    <span class="lever"></span>
                                                    Activo
                                                </label>
                                                <label v-else>
                                                    <input type="checkbox" v-model="checkboxes[props.row.vbt_id-1]" v-on:change="updateState(props.cell_value, props.row.vbt_id-1)" name="check-button">
                                                    <span class="lever"></span>
                                                    Inactivo
                                                </label>
                                            </div>
                                        </template>
                                    </vue-bootstrap4-table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Editar -->
        <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div v-if="loadEdit">
                            <h4><i class="fa fa-spinner fa-spin"></i> Cargando datos..</h4>
                        </div>
                        <div v-else>
                            <form action="" method="PUT" @submit.prevent="updateUser" id="form-update-user" autocomplete="off">
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="edit_identification" class="control-label">Identificación: </label>
                                                <input type="number" id="edit_identification" v-model="identification_edit" @blur="verifyDataUserEdit('identificaction')" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="edit_name" class="control-label">Nombres completos: </label>
                                                <input type="text" id="edit_name" v-model="names_edit" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="edit_email" class="control-label">Email: </label>
                                                <input type="email" id="edit_email" v-model="email_edit" @blur="verifyDataUserEdit('email')" class="form-control" required>
                                                <span v-if="loadEmail"><i class="fa fa-spinner fa-spin"></i> Validando correo</span>
                                                <span v-else></span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="edit_rol" class="control-label">Rol: </label>
                                                <select id="edit_rol" v-model="rol_id_edit" class="form-control" required>
                                                    <option v-for="rol in roles" :value="rol.id" v-text="rol.name"></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                    </div>
                                    <div class="row mt-3">
                                        <div class="col">
                                            <button type="submit" class="btn"> Actualizar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!--            Modal editar perimsos de sistema-->
        <div class="modal fade" id="ModalSystemPermission" tabindex="-1" role="dialog" aria-labelledby="ModalPermissionLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalSystemPermissionLabel">Permisos activos e inactivos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" v-for="(permission, key) in permissions">
                                    <div class="form-check">
                                        <label class="form-check-label">
<!--                                            <input class="form-check-input" type="checkbox" v-model="permission_selected_edit[key]" :value="permission.permission"  :id="'defaultCheck'+permission.id" v-on:change="updateRole(permission.permission, permission.status, key)">-->
                                            <input v-if="permission.state==='role'" class="form-check-input" type="checkbox" v-model="permission_selected_edit[key]" :value="permission.permission"  :id="'defaultCheck'+permission.id" disabled>
                                            <input v-else class="form-check-input" type="checkbox" v-model="permission_selected_edit[key]" :value="permission.permission"  :id="'defaultCheck'+permission.id" v-on:change="updateUserPermission(permission.permission, permission.status, key)">
                                            <span class="form-check-sign" v-text="permission.permission"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import VueBootstrap4Table from 'vue-bootstrap4-table'
    import axios from 'axios'
    import Multiselect from 'vue-multiselect'

    export default {
        name: "User",
        components: {VueBootstrap4Table, Multiselect },
        mounted() {
            this.getUsers();
            this.getRole();
        },
        data() {
            return {
                config: {
                    show_refresh_button: false,
                    show_reset_button: false,
                    per_page: 10,
                    card_mode: false,
                    global_search: {
                        placeholder: "Búsqueda",
                        visibility: true,
                        case_sensitive: false,
                        showClearButton: false,
                        searchOnPressEnter: false,
                    },
                },
                classes: {
                    table : {
                        "table table-hover": true,
                    },

                },
                columns: [
                    {
                        label: "#",
                        name: "cont",
                    },
                    {
                        label: "Identificación",
                        name: "identification",
                    },
                    {
                        label: "Nombres completos",
                        name: "name",
                    },
                    {
                        label: "Usuario",
                        name: "username",
                    },
                    {
                        label: "Rol",
                        name: "rol",
                    },
                    {
                        label: "Estado",
                        name: "status"
                    },
                    {
                        label: "Opciones",
                        name: "options",
                    }
                ],
                rows: [],
                formCreate: false,
                roles: [],
                rol_id: 0,
                identification: '',
                names: '',
                password: '',
                email: '',
                role_id: 0,
                loadIdentification: false,
                loadEmail: false,
                loadSave: false,
                loadEdit: false,
                identification_edit: '',
                names_edit: '',
                email_edit: '',
                rol_id_edit: '',
                permission_selected_edit: [],
                permissions: [],
                user: '',
                checkboxes: [],
            }
        },
        methods: {
            messageAlert: function(state, title, msj) {
                this.$swal({
                    icon: state,
                    title: title,
                    text: msj
                });
            },
            resetForm: function() {
                this.identification = '';
                this.names = '';
                this.email = '';
                this.rol_id =0;
            },
            eventButton: function (data) {
                if (data) {
                    this.generatePassword();
                    this.formCreate = true;
                    this.resetForm();
                } else {
                    this.formCreate = false;
                    this.getUsers();
                }
            },
            getUsers: function () {
                axios.get('/users-resource').then((response) => {
                    let users = response.data;
                    let checkboxes_aux = [];
                    for (let i in users){
                        let status = users[i].status == null ? 'activo': 'inactivo';
                        users[i].status = {
                            'id': users[i].options,
                            'status': status,
                        };
                        users[i].options = {
                            'id': users[i].options,
                            'rol': users[i].rol,
                        };
                        checkboxes_aux.push(status == 'activo' ? true : false);
                    }
                    this.rows = users;
                    this.checkboxes = checkboxes_aux;
                }).catch((error) => {
                    console.log(error.response);
                    return 0;
                });
            },
            getRole: function () {
                axios.get('/getRoles').then((response) => {
                    this.roles = response.data;
                }).catch((error) => {
                    console.log(error.response);
                });
            },
            //Verificar Datos del usuario
            verifyDataUser: function (data) {
                let param = '';
                if (data === 'identification') {
                    this.loadIdentification = true;
                    param = this.identification + '-identification';
                } else if (data === 'email') {
                    this.loadEmail = true;
                    param = this.email + '-email';
                }
                axios.get('/users-resource/' + param).then((response) => {
                    let result = response.data;
                    if (data === 'identification') {
                        this.loadIdentification = false;
                        if (result) {
                            this.identification = '';
                            this.messageAlert('warning', 'Atención', 'La cédula ingresada ya existe');
                        }
                    } else if (data === 'email') {
                        this.loadEmail = false;
                        if (result.length > 0) {
                            this.email = '';
                            this.messageAlert('warning', 'Atención', 'El correo ingresado ya existe');
                        }
                    }
                }).catch((error) => {
                    console.log(error.response);
                });
            },
            verifyDataUserEdit: function (data) {
                let param = '';
                if (data === 'identification') {
                    this.loadIdentification = true;
                    param = this.identification_edit + '-identification';
                } else if (data === 'email') {
                    this.loadEmail = true;
                    param = this.email_edit + '-email';
                }
                axios.get('/users-resource/' + param).then((response) => {
                    let result = response.data;
                    if (data === 'identification') {
                        this.loadIdentification = false;
                        if (result) {
                            this.identification_edit = '';
                            this.messageAlert('warning', 'Atención', 'La cédula ingresada ya existe');
                        }
                    } else if (data === 'email') {
                        this.loadEmail = false;
                        if (result.length > 0) {
                            this.email_edit = '';
                            this.messageAlert('warning', 'Atención', 'El correo ingresado ya existe');
                        }
                    }
                }).catch((error) => {
                    console.log(error.response);
                });
            },
            setUser: function () {
                if(this.rol_id==0 ){
                    this.messageAlert('warning', 'Información', 'Revisa el formulario, y comprueba que todos los campos estén diligenciados.');
                }else{
                    this.loadSave = true;
                    let formData = {
                        identification: this.identification,
                        name: this.names,
                        email: this.email,
                        password: this.password,
                        role_id: this.rol_id,
                    };
                    axios.post('/users-resource', formData).then((response) => {
                        this.loadSave = false;
                        $("#form-set-user")[0].reset();
                        if (response.data > 0) {
                            this.resetForm();
                            this.formCreate = false;
                            this.messageAlert('success', 'OK', 'El usuario ha sido registrado!');
                            this.getUsers();
                        } else {
                            this.messageAlert('warning', 'Atención', 'Debes recargar el navegador e intentar de nuevo');
                        }
                    }).catch((error) => {
                        this.loadSave = false;
                        this.messageAlert('warning', 'Información', 'Revisa el formulario, y comprueba que todos los campos estén diligenciados.');
                    });
                }
            },
            showUser: function (id) {
                $("#ModalEdit").modal('show');
                this.user_id = id;
                this.loadEdit = true;
                axios.get('/users-resource/' + id + '/edit').then((response) => {
                    let data = response.data;
                    let users = data.users;
                    let rol = data.role;
                    this.loadEdit = false;
                    this.rol_id_edit = rol.id;

                    this.identification_edit = users.identification;
                    this.names_edit = users.name;
                    this.email_edit = users.email;

                }).catch((error) => {
                    console.log(error.response);
                });
            },
            updateUser: function () {
                let formData = {
                    identification: this.identification_edit,
                    name: this.names_edit,
                    email: this.email_edit,
                    role_id: this.rol_id_edit,
                };
                axios.put('/users-resource/'+this.user_id, formData).then((response) => {
                    this.getUsers();
                    $("#ModalEdit").modal('hide');
                    this.messageAlert('success', 'OK', 'El usuario ha sido actualizado');

                }).catch((error) => {
                    console.log(error.data);
                });
            },

            getPermissions: function(id){
                $("#ModalSystemPermission").modal('show');
                this.user = id
                axios.get('/getUserPermission/'+id).then(response => {
                    this.permissions = [];
                    this.permission_selected_edit = [];
                    let permissions_aux = [];
                    let count = 1;
                    for(let i in response.data){
                        let state_check = '';
                        let state = '';
                        let status = '';
                        if (response.data[i].role_status == 'activo' && response.data[i].user_status == 'activo') {
                            status = 'activo';
                            state_check = true;
                            state = "role";
                        }else if (response.data[i].role_status == 'activo' && response.data[i].user_status == 'inactivo'){
                            status = 'activo';
                            state_check = true;
                            state = "role";
                        }else if (response.data[i].role_status == 'inactivo' && response.data[i].user_status == 'activo'){
                            status = 'activo';
                            state_check = true;
                        }else if (response.data[i].role_status == 'inactivo' && response.data[i].user_status == 'inactivo'){
                            status = 'inactivo';
                            state_check = false;
                        }
                        this.permission_selected_edit.push(state_check);
                        permissions_aux.push({"id": count++, "permission": response.data[i].name, "status": status, "state": state});
                    }
                    this.permissions = permissions_aux;
                }).catch(e => {
                    console.log(e);
                });
            },
            updateUserPermission: function(name, status, id){
                let formData = {
                    name: name,
                    status: status
                };

                axios.post('/updateUserPermission/'+this.user, formData).then(response => {
                    if (status == 'activo'){
                        this.permissions[id].status ='inactivo';
                    }else if (status == 'inactivo'){
                        this.permissions[id].status = 'activo';
                    }
                    // this.getPermissions(this.user);
                }).catch(e => {
                    console.log(e);
                });
            },
            generatePassword: function() {
                //this.password='';
                let caracteres = "abcdefghijkmnpqrtuvwxyzABCDEFGHJKMNPQRTUVWXYZ012346789%#()/?¿¡!*%&{}[]+-_";
                let contrasena = "";
                for (let i=0; i<12; i++) {
                    contrasena +=caracteres.charAt(Math.floor(Math.random()*caracteres.length));
                }
                this.password=contrasena;
                //console.log(this.password);
            },

            updateState: function(param, index){
                let id = param.id;
                let state = param.status;
                let formData = {
                    id: id,
                    state: state
                };
                axios.post('/updateStateUser', formData).then((response) => {
                    this.messageAlert('success', 'OK', 'Estado actualizado!');
                    this.rows[index].status.status=response.data;
                }).catch((error) => {
                    console.log(error);
                });
            },
        },

    }
</script>

<style scoped>
    button {
        color: #ffffff;
        background: #03B8AD;
    }
    .clr-font {
        color: #03B8AD !important;
    }
</style>
