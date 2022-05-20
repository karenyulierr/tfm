<template>
    <div>
        <div class="page-inner">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header" style="background: #E7E7E7">
                            <div class="card-title">
                                <template>
                                    <div class="pull-right">
                                        <button class="btn" style="background: #555555; color: white" @click="getPermission" v-b-modal.create-rol>Agregar rol <i class="fa fa-plus"></i></button>
                                    </div>
                                    <h2 class="clr-font"><b>Roles</b></h2>
                                </template>
                            </div>
                        </div>
                        <div class="card-body">
                            <vue-bootstrap4-table :rows="rows" :columns="columns" :config="config">
                                <template slot="options" slot-scope="props">
                                    <b-button size="sm"class="btn-tble" v-b-modal.update-rol @click="getPermissionId(props.cell_value)" title="Editar Rol"><i class="fa fa-edit text-white"></i></b-button>
                                </template>
                            </vue-bootstrap4-table>
                        </div>
                    </div>
                </div>
                <b-modal id="create-rol" v-model="modalCreate" modal-cancel size="lg" title="AGREGAR ROL" hide-footer>
                    <b-form v-on:submit.prevent="setRole()">
                         <div class="row">
                             <div class="col">
                                 <b-form-group label="Nombre:" label-for="name">
                                     <b-form-input id="name" v-model="name_rol" placeholder="Digite el nombre del rol" required></b-form-input>
                                 </b-form-group>
                             </div>
                         </div>
                        <div class="row justify-content-center mt-4">
                            <h5>LISTA DE PERMISOS</h5>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" v-for="permission in permissions_list">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" v-model="permission_selected" :value="permission.name" :id="'customControlAutosizing'+permission.id">
                                    <label class="custom-control-label" v-text="permission.name" :for="'customControlAutosizing'+permission.id" style="cursor: pointer;"></label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12 text-center" v-if="loadCreate">
                                <button type="submit" class="btn"> Guardar</button>
                            </div>
                            <div class="col-md-12 col-lg-12 col-sm-12 text-center" v-else>
                                <i class="fa fa-spinner fa-spin"></i> Guardando...
                            </div>
                        </div>
                    </b-form>
                </b-modal>
                <b-modal id="update-rol" v-model="modalEdit" modal-cancel size="lg" title="EDITAR ROL" hide-footer>
                    <b-form v-on:submit.prevent="updateRole()">
                        <div class="row">
                            <div class="col">
                                <b-form-group label="Nombre:" label-for="name">
                                    <b-form-input id="name" v-model="name_rol_edit" placeholder="Digite el nombre del rol" required></b-form-input>
                                </b-form-group>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <h5>LISTA DE PERMISOS</h5>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" v-for="(permission, key) in permissions">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" v-model="permission_selected_edit[key]" :value="permission.permission" :id="'customControlValidation'+permission.id" v-on:change="updateRole(permission.permission, permission.status, key)">
                                    <label class="custom-control-label" v-text="permission.permission" :for="'customControlValidation'+permission.id" style="cursor: pointer;"></label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12 text-center" v-if="loadCreate">
                                <button type="submit" class="btn">
                                    Editar
                                </button>
                            </div>
                            <div class="col-md-12 col-lg-12 col-sm-12 text-center" v-else>
                                <i class="fa fa-spinner fa-spin"></i> Editando...
                            </div>
                        </div>
                    </b-form>
                </b-modal>

            </div>

        </div>
    </div>

</template>

<script>
import axios from 'axios'
import VueBootstrap4Table from 'vue-bootstrap4-table'
export default {
name: "Roles",
    mounted() {
        this.getRoles();
    },
    data: function () {
        return {
            rows:[],
            titleModal:'',
            columns: [{label: "#", name: "item", sort: true},{label: "Rol", name: "name"},{label: "Opciones", name: "options"}],
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
            modalEdit: false,
            modalCreate: false,
            loadCreate: true,
            role: '',
            name_rol: '',
            name_rol_edit: '',
            permissions_list: [],
            permission_selected: [],
            permissions: [],
            permission_selected_edit: [],
            checkboxes: [],
        }
    },
    methods: {
        getRoles: function () {
            axios.get('/getRoles').then(response => {
                this.rows = [];
                //this.rows = response.data;
                let role_aux = [];
                let count = 1;
                //console.log(response.data);
                for(let i in response.data){
                    role_aux.push({"item": count++, "name": response.data[i].name, "options": response.data[i].id});
                }
                this.rows = role_aux;
            }).catch(e => {
                console.log(e.response);
            });
        },
        getPermission: function() {
            this.permission_selected = [];
            axios.get('/getAllPermission').then((response) => {
                this.permissions_list = response.data;
            }).catch((error) => {
                console.log(error);
            });
        },
        getPermissionId: function(id) {
            this.permissions = [];
            this.permission_selected_edit = [];
            this.role = id;
            axios.get('/getPermissionsRole/'+id).then((response) => {
                let permissions_aux = [];
                let aux = [];
                let count = 1;
                for(let i in response.data[0]){
                    let state_check = '';
                    if(response.data[0][i].status == 'activo') {
                        state_check = true;
                    }else{
                        state_check = false;
                    }
                    this.permission_selected_edit.push(state_check);
                    permissions_aux.push({"id": count++, "permission": response.data[0][i].name, "status": response.data[0][i].status});
                    aux.push(response.data[0][i].status == 'activo' ? true : false);
                }
                this.name_rol_edit = response.data[1].name;
                this.checkboxes = aux;
                this.permissions = permissions_aux;
                this.loader = 'true';
            }).catch((error) => {
                console.log(error);
            });
        },
        setRole: function() {
            this.loadCreate = true;
            if(this.name_rol!='' ){
                let formData = {
                    name: this.name_rol,
                    permissions: this.permission_selected
                };
                axios.post('/setRole', formData).then((response) => {
                    if(response.data == 'exist'){
                        this.messageAlert('warning','Lo sentimos!','El rol ya existe!');
                    }else{
                        this.messageAlert('success','Correcto!','Rol creado con éxito!');
                        this.loadCreate = true;
                        $("#ModalCreate").modal('hide');
                        this.getRoles();
                        this.name_rol = '';
                        this.$bvModal.hide('create-rol')
                    }
                }).catch((error) => {
                    console.log(error);
                    this.loadCreate = false;
                });
            }else{
                this.messageAlert('warning','Lo sentimos!','Por favor ingrese todos los datos');
            }
        },

        updateRole: function(name, status, index){
            let formData = {
                name: name,
                status: status,
                name_rol: this.name_rol_edit
            };
            axios.post('/updateRole/'+this.role, formData).then(response => {
                console.log(response.data);
                if (status == 'activo'){
                    this.permissions[index].status ='inactivo';
                }else if (status == 'inactivo'){
                    this.permissions[index].status = 'activo';
                }
                this.getRoles();
                this.$bvModal.hide('update-rol')
                this.messageAlert('success','Correcto!','Rol actualizado!');
            }).catch(e => {
                console.log(e);
            });
        },
        messageAlert: function(state, title, msj) {
            this.$swal({
                icon: state,
                title: title,
                text: msj
            });
        },
    },
    components: {
        VueBootstrap4Table
    }
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
    .btn-tble{
        background-color:rgb(108, 117, 125) !important;
        border: none;
    }
</style>
