<template>
    <div>
        <div class="page-inner">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header" style="background: #E7E7E7">
                            <div class="card-title" v-if="showCreate">
                                <template>
                                    <div class="pull-right" v-if="$can('Crear planes turísticos')">
                                        <button class="btn" style="background: #555555; color: white" @click="createFile(),band='create',see=false, band_edit=false">Agregar plan <i class="fa fa-plus"></i></button>
                                    </div>
                                    <h2 class="clr-font"><b>Planes turísticos</b></h2>
                                </template>
                            </div>
                            <div class="card-title" v-if="site">
                                <template>
                                    <div class="pull-right">
                                        <button class="btn" style="background: #555555; color: white" @click="showCreate=true, site=false"><i class="fa fa-arrow-left"></i> Regresar </button>
                                    </div>
                                    <h2 class="clr-font" v-if="band=='create'"><b>Agregar plan turístico</b></h2>
                                    <h2 class="clr-font" v-if="see"><b>Detalle plan turístico</b></h2>
                                    <h2 class="clr-font" v-if="band_edit"><b>Editar plan turístico</b></h2>
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
                                                <a class="dropdown-item" href="#" v-on:click="getTouristPlanId(props.cell_value),band='update', see=true, showCreate=false, site=true, band_edit=false"><i class="fas fa-eye"></i> Detalle </a>
                                                <a class="dropdown-item" href="#" v-on:click="getTouristPlanId(props.cell_value),band='update', see=false, band_edit=true"><i class="fas fa-edit"></i> Editar </a>
                                                <a class="dropdown-item" href="#" v-on:click="images(props.cell_value, props.row.name),see=false,band='create',band_edit=false"><i class="fas fa-images"></i> Imagenes</a>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                                <template slot="status" slot-scope="props">
                                    <div class="switch">
                                        <label v-if="props.cell_value[0].status == 'activo'" class="switch">
                                            <input type="checkbox" v-model="checkboxes[props.row.vbt_id-1]" @change="statePlanSite(props.row.options, 'inactive','Inactivo')" name="check-button" checked>
                                            <span class="lever"></span><br>
                                            Activo
                                        </label>
                                        <label v-else-if="props.cell_value[0].status == 'inactivo'" class="switch">
                                            <input type="checkbox" v-model="checkboxes[props.row.vbt_id-1]" @change="statePlanSite(props.row.options, 'active', 'Activo')" name="check-button" >
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
                                    <b-form-group label="Nombre del plan:">
                                        <b-form-textarea
                                            id="textarea1"
                                            v-model="name"
                                            rows="2"
                                            :disabled="see"
                                            @blur="verifyDataPlan('name')"
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
                            <div class="row">
                                <div class="col-4">
                                    <b-form-group label="Valor:" id="fieldset-file1" lass="mt-3" class="mt-3">
                                        <input type="text" v-model="value" @input="formatNum(value,1)" class="form-control" required :disabled="see"/>
                                    </b-form-group>
                                </div>
                                <div class="col-8">
                                    <b-form-group id="fieldset-file1" lass="mt-3" label="Sitios turísticos:" class="mt-3">
                                        <multiselect v-model="sites" deselect-label="Can't remove this value" track-by="name" label="name" :disabled="see" placeholder="Seleccione una opción" :options="sites_opt" :searchable="true" :allow-empty="true"  :multiple="true" required>
                                            <template slot="singleLabel" slot-scope="{ option }">{{ option.name }}</template>
                                        </multiselect>
                                    </b-form-group>
                                </div>
                            </div>
                            <div class="row form-group mt-3" v-if="!see">
                                <div class="col-md-12 col-lg-12 col-sm-12 text-center" v-if="loadCreate">
                                    <button type="btn" class="btn btn-primary" @click="setTouristPlan()"><i class="fas fa-save"></i> Guardar</button>
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
        this.getTouristPlan();
        this.getSites();
    },
    data: function () {
        return {
            rows:[],
            titleModal:'',
            columns: [{label: "#", name: "item", sort: true},{label: "Nombre", name: "name"},{label: "Descripción", name: "description"},{label: "Precio", name: "value"},{label: "Estado",name: "status"},{label: "Opciones", name: "options"}],
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
            band_edit: false,
            band:'',
            site:'',
            plan_id:'',
            name:'',
            description:'',
            value:'',
            image_main:'',
            sites:[],
            sites_opt:[],
            checkboxes: [],
        }
    },
    methods: {

        getTouristPlan: function () {
            this.rows = [];
            let count = 1;
            let checkboxes_aux = [];
            let service_aux = [];
            axios.get('plan-resource?Q=0').then(response => {
                let data = response.data;
                for(let i in data){
                    let status_aux = response.data[i].state == 'active' ? 'activo': 'inactivo';
                    let arr = [];
                    let formData = {
                        status: status_aux,
                        id: response.data[i].id
                    };
                    arr.push(formData);
                    service_aux.push({"item": count++, "name": response.data[i].name, "description": response.data[i].description, "value": response.data[i].value,"status": arr, "options": response.data[i].id});
                    checkboxes_aux.push(response.data[i].state == 'active' ? true : false);
                }
                this.rows = service_aux;
                this.checkboxes = checkboxes_aux;
            });
        },
        setTouristPlan: function() {
            this.loadCreate = false;
            if (this.name != ''  && this.value != '' && this.sites.length>0) {

                let formData = new FormData;
                formData.append('name', this.name);
                formData.append('description', this.description);
                formData.append('value', this.value);
                formData.append('image_main', this.image_main);
                formData.append('band', this.band);
                formData.append('id', this.plan_id);
                formData.append('sites', JSON.stringify(this.sites));
                const config = {
                    headers: {'content-type': 'multipart/form-data'}
                };
                axios.post('/plan-resource', formData, config).then(response => {
                    this.getTouristPlan();
                    this.messageAlert('success', 'Correcto!', 'Plan turístico guardado exitosamente!');
                    this.loadCreate = true;
                    this.site = false;
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


        },
        getTouristPlanId: function (id) {
            this.createFile();
            this.plan_id = id;
            axios.get('/plan-resource/' + id + '/edit').then((response) => {
                let data = response.data[0];
                let sites = response.data[1];
                this.name = data.name;
                this.description = data.description;
                this.value = data.value;
                this.image_main = data.main_image;

                for(let i=0;i<sites.length;i++){
                    this.sites.push({id:sites[i].id,name:sites[i].name});
                }
            }).catch((error) => {
                console.log(error.response);
            });
        },
        getSites: function (){
            axios.get('plan-resource?Q=1').then(response => {
                this.sites_opt=[];
                let data = response.data;
                for(let i in data){
                    this.sites_opt.push({
                        "id": data[i].id,
                        "name": data[i].name,
                    });
                }
            });
        },
        verifyDataPlan: function (data) {
            let param = '';
            if (data === 'name') {
                this.loadName = true;
                param = this.name + '-name';
            } else if (data === 'nit') {
                this.loadNit = true;
                param = this.nit + '-nit';
            }
            axios.get('/plan-resource/' + param).then((response) => {
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
        statePlanSite: function(id, state){
            let formData = {
                id: id,
                state: state
            };
            axios.put('/plan-resource/'+id, formData).then((response) => {
                //Success
                this.messageAlert('success', 'Correcto!', 'Estado actualizado');
                this.getTouristPlan();

            }).catch((error) => {
                console.log(error.response);
            });
        },
        formatNum: function(input,index)
        {
            let number = input;
            let num = number.replace(/\./g,'');
            if(!isNaN(num)){
                num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
                num = num.split('').reverse().join('').replace(/^[\.]/,'');
                if (index == 1){
                    this.value = num;
                }
            }else{
                this.messageAlert('warning', 'Atención!', 'Solo se permiten números');
                if (index == 1){
                    this.value = this.value.replace(/[^\d\.]*/g,'');
                }

            }
        },
        clear: function (){
            this.name = '';
            this.description = '';
            this.value = '';
            this.image_main = '';
            this.plan_id = '';
            this.sites = [];
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
        images: function (id,name) {
            localStorage.setItem('plan_id', JSON.stringify(id));
            localStorage.setItem('name_plan', JSON.stringify(name));
            this.$router.push({path: '/imagePlan'});
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
