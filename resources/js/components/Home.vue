<template>
    <div>
        <div class="page-inner">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header" style="background: #E7E7E7">
                            <div class="card-title" v-if="showCreate">
                                <template>
                                    <div class="pull-right" v-if="$can('Crear sitios turísticos')">
                                        <button class="btn" style="background: #555555; color: white" @click="createFile(),band='create'">Agregar sitio <i class="fa fa-plus"></i></button>
                                    </div>
                                    <h2 class="clr-font"><b>Sitios turísticos</b></h2>
                                </template>
                            </div>
                            <div class="card-title" v-if="site">
                                <template>
                                    <div class="pull-right">
                                        <button class="btn" style="background: #555555; color: white" @click="showCreate=true, site=false"><i class="fa fa-arrow-left"></i> Regresar </button>
                                    </div>
                                    <h2 class="clr-font"><b>Agregar sitio turístico</b></h2>
                                </template>
                            </div>
                        </div>
                        <div class="card-body" v-if="showCreate">
                            <vue-bootstrap4-table :rows="rows" :columns="columns" :config="config">
                                <template slot="options" slot-scope="props">
                                    <div class="dropdown">
                                        <button class="btn btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #6c757d">
                                            <i class="fas fa-tool"></i> Ver opciones
                                        </button>
                                        <div>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <a class="dropdown-item" href="#" v-on:click="getTouristSiteId(props.cell_value),band='update', see=true, showCreate=false, site=false"><i class="fas fa-eye"></i> Detalle </a>
                                                <a class="dropdown-item" href="#" v-on:click="getTouristSiteId(props.cell_value),band='update', see=false"><i class="fas fa-edit"></i> Editar </a>
                                                <a class="dropdown-item" v-on:click="rules(props.cell_value, props.row.name),see=false"><i class="fas fa-list-ol"></i> Reglas</a>
                                                <a class="dropdown-item" href="#" v-on:click="services(props.cell_value, props.row.name),see=false"><i class="fas fa-clipboard-list"></i> Servicios</a>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                                <template slot="status" slot-scope="props">
                                    <div class="switch">
                                        <label v-if="props.cell_value[0].status == 'activo'" class="switch">
                                            <input type="checkbox" v-model="checkboxes[props.row.vbt_id-1]" @change="stateTouristSite(props.row.options, 'inactive','Inactivo')" name="check-button" checked>
                                            <span class="lever"></span><br>
                                            Activo
                                        </label>
                                        <label v-else-if="props.cell_value[0].status == 'inactivo'" class="switch">
                                            <input type="checkbox" v-model="checkboxes[props.row.vbt_id-1]" @change="stateTouristSite(props.row.options, 'active', 'Activo')" name="check-button">
                                            <span class="lever"></span><br>
                                            Inactivo
                                        </label>
                                    </div>
                                </template>
                            </vue-bootstrap4-table>
                        </div>
                        <div class="card-body" v-if="site">
                            <div class="row" >
                                <div class="col-6">
                                    <b-form-group label="Nombre del sitio:">
                                        <b-form-textarea
                                            id="textarea1"
                                            v-model="name"
                                            rows="2"
                                            :disabled="see"
                                            @blur="verifyDataSite('name')"
                                        ></b-form-textarea>
                                        <span v-if="loadName"><i class="fa fa-spinner fa-spin"></i> Validando nombre</span>
                                        <span v-else></span>
                                    </b-form-group>
                                </div>
                                <div class="col-6">
                                    <b-form-group label="Descripción:">
                                        <b-form-textarea
                                            id="textarea"
                                            v-model="description"
                                            rows="3"
                                            :disabled="see"
                                        ></b-form-textarea>
                                    </b-form-group>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <b-form-group label="Nit:">
                                        <input type="text" v-model="nit" class="form-control" @keypress="onlyNumber" @blur="verifyDataSite('nit')" required :disabled="see"/>
                                        <span v-if="loadNit"><i class="fa fa-spinner fa-spin"></i> Validando nit</span>
                                        <span v-else></span>
                                    </b-form-group>
                                </div>
                                <div class="col-4">
                                    <b-form-group label="Email:">
                                        <input type="text" v-model="email" class="form-control" required :disabled="see"/>
                                    </b-form-group>
                                </div>
                                <div class="col-4">
                                    <b-form-group label="Teléfono:">
                                        <input type="text" v-model="phone" class="form-control" required :disabled="see"/>
                                    </b-form-group>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <b-form-group label="Dirección:">
                                        <input type="text" v-model="address" class="form-control" required :disabled="see"/>
                                    </b-form-group>
                                </div>
                                <div class="col-4">
                                    <b-form-group label="Latitud:">
                                        <input type="text" v-model="latitude" class="form-control" required :disabled="see"/>
                                    </b-form-group>
                                </div>
                                <div class="col-4">
                                    <b-form-group label="Longitud:">
                                        <input type="text" v-model="longitude" class="form-control" required :disabled="see"/>
                                    </b-form-group>
                                </div>
                            </div>
                            <div class="row" v-if="!see">
                                <div class="col">
                                    <b-form-group id="fieldset-file1" label-class="font-weight-bold" class="mt-3" label="Imagen principal del sitio:">
                                        <input type="file" class="fileinputImage" v-on:change="changePhoto" required>
                                    </b-form-group>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-center mt-2" v-if="see">
                                <b-col md="6" class="justify-content-center">
                                    <b-form-group id="fieldset-file1" label-class="font-weight-bold" class="mt-3" label="Imagen principal del sitio:">
                                        <b-card-img :src="'soportes/img_main/'+image_main" alt="Image" class="rounded-0"></b-card-img>
                                    </b-form-group>
                                </b-col>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">
                                    <b-form-group id="fieldset-start_time" label="Hora inicio:">
                                        <input type="time" class="form-control" v-model="start_time" :disabled="see" required>
                                    </b-form-group>
                                </div>
                                <div class="col-6">
                                    <b-form-group id="fieldset-start_time" label="Hora fin:">
                                        <input type="time" class="form-control" v-model="end_time" :disabled="see" required>
                                    </b-form-group>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <b-form-group id="fieldset-file1" lass="mt-3" label="Administrador del sitio:" class="mt-3">
                                        <multiselect v-model="user_admin" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="Seleccione una opción" :options="user_admin_opt" :searchable="true" :allow-empty="true" :disabled="see" :multiple="false" required>
                                            <template slot="singleLabel" slot-scope="{ option }">{{ option.name }}</template>
                                        </multiselect>
                                    </b-form-group>
                                </div>
                                <div class="col-6">
                                    <b-form-group id="fieldset-file1" lass="mt-3" label="Categorias:" class="mt-3">
                                        <multiselect v-model="categories" deselect-label="Can't remove this value" track-by="name" label="name" :disabled="see" placeholder="Seleccione una opción" :options="categorie_opt" :searchable="true" :allow-empty="true"  :multiple="true" required>
                                            <template slot="singleLabel" slot-scope="{ option }">{{ option.name }}</template>
                                        </multiselect>
                                    </b-form-group>
                                </div>
                            </div>
                            <div class="row form-group mt-3" v-if="!see">
                                <div class="col-md-12 col-lg-12 col-sm-12 text-center" v-if="loadCreate">
                                    <button type="btn" class="btn btn-primary" @click="setTouristSite()"><i class="fas fa-save"></i> Guardar</button>
                                    <button type="btn" class="btn btn-danger" @click="clear()"><i class="fas fa-window-close"></i> Cancelar</button>
                                </div>
                                <div class="col-md-12 col-lg-12 col-sm-12 text-center" v-else>
                                    <i class="fa fa-spinner fa-spin"></i> Guardando...
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
import VueBootstrap4Table from "vue-bootstrap4-table";
import axios from "axios";
import Multiselect from "vue-multiselect";

export default {
    mounted() {
        this.getTouristSite();
        this.getAdminSite();
    },
    data: function () {
        return {
            rows:[],
            rows_rules:[],
            titleModal:'',
            columns: [{label: "#", name: "item", sort: true},{label: "Nombre", name: "name"},{label: "Nit", name: "nit"},{label: "Teléfono", name: "phone"},{label: "Dirección", name: "address"},{label: "Estado",name: "status"},{label: "Opciones", name: "options"}],
            columns_rules: [{label: "#", name: "item", sort: true},{label: "Regla", name: "name"},{label: "Estado",name: "status"},{label: "Opciones", name: "options"}],
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
            showCreate: true,
            loadCreate: true,
            loadNit: false,
            loadName: false,
            see: false,
            band:'',
            site:'',
            site_id:'',
            name:'',
            description:'',
            nit:'',
            email:'',
            phone:'',
            address:'',
            latitude:'',
            longitude:'',
            start_time:'',
            end_time:'',
            image_main:'',
            user_admin:'',
            categories:[],
            user_admin_opt:[],
            categorie_opt:[],
            checkboxes: [],
        }
    },
    methods: {

        getTouristSite: function () {
            this.rows = [];
            let count = 1;
            let checkboxes_aux = [];
            let service_aux = [];
            axios.get('tourist-site-resource?Q=0').then(response => {
                let data = response.data;
                for(let i in data){
                    let status_aux = response.data[i].state == 'active' ? 'activo': 'inactivo';
                    let arr = [];
                    let formData = {
                        status: status_aux,
                        id: response.data[i].id
                    };
                    arr.push(formData);
                    service_aux.push({"item": count++, "name": response.data[i].name, "nit": response.data[i].nit, "phone": response.data[i].phone,"address": response.data[i].address, "status": arr, "options": response.data[i].id});
                    checkboxes_aux.push(response.data[i].state == 'active' ? true : false);
                }
                this.rows = service_aux;
                this.checkboxes = checkboxes_aux;
            });
        },
        setTouristSite: function() {
            this.loadCreate = false;
            var emailValidation = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
            if(emailValidation.test(this.email)) {
                if (this.name != ''  && this.nit != '' && this.email != '' && this.phone != '' && this.address != '' && this.latitude != '' && this.longitude != ''&& this.start_time != ''&& this.end_time != ''&& this.image_main != ''&& this.user_admin != ''&& this.categories.length>0) {

                    let formData = new FormData;
                    formData.append('name', this.name);
                    formData.append('description', this.description);
                    formData.append('nit', this.nit);
                    formData.append('email', this.email);
                    formData.append('phone', this.phone);
                    formData.append('address', this.address);
                    formData.append('latitude', this.latitude);
                    formData.append('longitude', this.longitude);
                    formData.append('start_time', this.start_time);
                    formData.append('end_time', this.end_time);
                    formData.append('image_main', this.image_main);
                    formData.append('user_admin', this.user_admin.id);
                    formData.append('band', this.band);
                    formData.append('id', this.site_id);
                    formData.append('categories', JSON.stringify(this.categories));
                    const config = {
                        headers: {'content-type': 'multipart/form-data'}
                    };
                    axios.post('/tourist-site-resource', formData, config).then(response => {
                        this.getTouristSite();
                        this.messageAlert('success', 'Correcto!', 'Sitio turístico guardado exitosamente!');
                        this.loadCreate = true;
                        this.showCreate = true;
                        this.clear();
                    }).catch(e => {
                        console.log(e);
                        this.loadCreate = true;
                    });
                } else {
                    this.loadCreate = true;
                    this.messageAlert('warning', 'Atención!', 'Por favor diligencie todos los campos.');
                }
            }else{
                this.loadCreate = true;
                this.messageAlert('warning','Atención!','Email inválido!!');
            }

        },
        getTouristSiteId: function (id) {
            this.createFile();
            this.site_id = id;
            axios.get('/tourist-site-resource/' + id + '/edit').then((response) => {
                let data = response.data[0];
                let user = response.data[1];
                let cat = response.data[2];
                this.name = data.name;
                this.description = data.description;
                this.nit = data.nit;
                this.email = data.email;
                this.phone = data.phone;
                this.address = data.address;
                this.latitude = data.latitude;
                this.longitude = data.longitude;
                this.start_time = data.start_time;
                this.end_time = data.end_time;
                this.image_main = data.main_image;
                this.user_admin = {id:user.id, name:user.name};
                for(let i=0;i<response.data[2].length;i++){
                    this.categories.push({id:cat[i].id,name:cat[i].name});
                }
            }).catch((error) => {
                console.log(error.response);
            });
        },
        getAdminSite: function (){
            axios.get('tourist-site-resource?Q=1').then(response => {
                this.user_admin_opt=[];
                this.categorie_opt=[];
                let data = response.data[0];
                for(let i in data){
                    this.user_admin_opt.push({
                        "id": data[i].id,
                        "name": data[i].name,
                    });
                }
                let cat = response.data[1];
                for(let i in cat){
                    this.categorie_opt.push({
                        "id": cat[i].id,
                        "name": cat[i].name,
                    });
                }
            });
        },
        stateTouristSite: function(id, state){
            let formData = {
                id: id,
                state: state
            };
            axios.put('/tourist-site-resource/'+id, formData).then((response) => {
                //Success
                this.messageAlert('success', 'Correcto!', 'Estado actualizado');
                this.getTouristSite();

            }).catch((error) => {
                console.log(error.response);
            });
        },
        clear: function (){
            this.name = '';
            this.description = '';
            this.nit = '';
            this.email = '';
            this.phone = '';
            this.address = '';
            this.latitude = '';
            this.longitude = '';
            this.start_time = '';
            this.end_time = '';
            this.image_main = '';
            this.user_admin = '';
            this.categories = [];
        },
        createFile:function (){
            this.showCreate=false;
            this.site=true;
            this.clear();
            setTimeout(function() {
                $(".fileinputImage").fileinput({
                    'overwriteInitial': false,
                    'allowedFileExtensions': ['png','jpg','jpeg'],
                    'showUpload': false,
                    'theme': 'fas',
                    'previewFileType': 'any',
                    'maxFileCount': 1,
                    'language': 'es',
                    'previewFileIcon': '<i class="fas fa-file"></i>',
                });
            });
        },
        verifyDataSite: function (data) {
            let param = '';
            if (data === 'name') {
                this.loadName = true;
                param = this.name + '-name';
            } else if (data === 'nit') {
                this.loadNit = true;
                param = this.nit + '-nit';
            }
            axios.get('/tourist-site-resource/' + param).then((response) => {
                let result = response.data;
                if (data === 'name') {
                    this.loadName = false;
                    if (result) {
                        this.name = '';
                        this.messageAlert('warning', 'Atención', 'El nombre ingresado ya existe');
                    }
                } else if (data === 'nit') {
                    this.loadNit = false;
                    if (result > 0) {
                        this.nit = '';
                        this.messageAlert('warning', 'Atención', 'El nit ingresado ya existe');
                    }
                }
            }).catch((error) => {
                console.log(error.response);
            });
        },
        rules: function (id,name) {

            localStorage.setItem('site_id', JSON.stringify(id));
            localStorage.setItem('name_site', JSON.stringify(name));
            this.$router.push({path: '/rule'});
        },
        services: function (id,name) {
            localStorage.setItem('site_id', JSON.stringify(id));
            localStorage.setItem('name_site', JSON.stringify(name));
            this.$router.push({path: '/serviceSite'});
        },
        messageAlert: function(state, title, msj) {
            this.$swal({
                icon: state,
                title: title,
                text: msj
            });
        },
        changePhoto: function(e) {
            this.image_main = e.target.files[0];
        },
        onlyNumber ($event) {
            let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
            if (keyCode < 48 || keyCode > 57 || keyCode == 46) {
                $event.preventDefault();
            }
        },
    },
    components: {
        VueBootstrap4Table,
        Multiselect
    }

};
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
