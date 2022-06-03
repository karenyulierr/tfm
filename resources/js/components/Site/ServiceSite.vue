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
                                        <button class="btn" style="background: #555555; color: white" @click="removeLocal()"><i class="fa fa-arrow-left"></i> Regresar </button>
                                    </div>
                                    <h2 class="clr-font"><b>Servicios de {{name_site}}</b></h2>
                                </template>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="offset-md-2 offset-lg-2 col-md-8 col-lg-8">
                                    <b-form @submit.prevent="setServiceSite()" autocomplete="off">
                                        <b-form-group id="fieldset-file1" lass="mt-2" label="Servicio:">
                                            <multiselect v-model="service" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="Seleccione una opción" :options="service_opt" :searchable="true" :allow-empty="true" :multiple="false" required>
                                                <template slot="singleLabel" slot-scope="{ option }">{{ option.name }}</template>
                                            </multiselect>
                                        </b-form-group>
                                        <div class="row">
                                            <div class="col-6">
                                                <b-form-group id="fieldset-file1" lass="mt-2" label="Día inicial:" class="mt-2">
                                                    <multiselect v-model="start_day" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="Seleccione una opción" :options="day_opt" :searchable="true" :allow-empty="true"  :multiple="false" required>
                                                        <template slot="singleLabel" slot-scope="{ option }"> {{ option.name }}</template>
                                                    </multiselect>
                                                </b-form-group>
                                            </div>
                                            <div class="col-6">
                                                <b-form-group id="fieldset-file1" lass="mt-2" label="Día final:"  class="mt-2">
                                                    <multiselect v-model="end_day" deselect-label="Can't remove this value" track-by="name" label="name" placeholder="Seleccione una opción" :options="day_opt" :searchable="true" :allow-empty="true" :multiple="false" required>
                                                        <template slot="singleLabel" slot-scope="{ option }">{{ option.name }}</template>
                                                    </multiselect>
                                                </b-form-group>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <b-form-group id="fieldset-file1" lass="mt-2" label="Valor:" class="mt-2">
                                                    <input type="number" v-model="price" class="form-control" required />
                                                </b-form-group>
                                            </div>
                                        </div>
                                        <div class="row form-group mt-3">
                                            <div class="col-md-12 col-lg-12 col-sm-12 text-center" v-if="loadCreate">
                                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                                                <button type="button" class="btn btn-danger" @click="reset()"><i class="fas fa-window-close"></i> Cancelar</button>
                                            </div>
                                            <div class="col-md-12 col-lg-12 col-sm-12 text-center" v-else>
                                                <i class="fa fa-spinner fa-spin"></i> Guardando...
                                            </div>
                                        </div><br>
                                    </b-form>
                                </div>

                            </div>

                            <vue-bootstrap4-table :rows="rows" :columns="columns" :config="config">
                                <template slot="options" slot-scope="props">
                                    <b-button size="sm" class="btn-tble" href="#category" @click="getServiceId(props.cell_value), band_service='update'" title="Editar Regla"><i class="fa fa-edit text-white"></i></b-button>
                                </template>
                                <template slot="status" slot-scope="props">
                                    <div class="switch">
                                        <label v-if="props.cell_value[0].status == 'activo'" class="switch">
                                            <input type="checkbox" v-model="checkboxes[props.row.vbt_id-1]" @change="stateServiceSite(props.row.options, 'inactive','Inactivo')" name="check-button" checked>
                                            <span class="lever"></span><br>
                                            Activo
                                        </label>
                                        <label v-else-if="props.cell_value[0].status == 'inactivo'" class="switch">
                                            <input type="checkbox" v-model="checkboxes[props.row.vbt_id-1]" @change="stateServiceSite(props.row.options, 'active', 'Activo')" name="check-button">
                                            <span class="lever"></span><br>
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
</template>

<script>
import axios from "axios";
import VueBootstrap4Table from "vue-bootstrap4-table";
import Multiselect from "vue-multiselect";

export default {
name: "ServiceSite",
    mounted() {
        this.site_id = JSON.parse(localStorage.getItem('site_id'));
        this.name_site = JSON.parse(localStorage.getItem('name_site'));
        this.getServiceSite();
        this.getServiceActive();
    },
    data: function () {
        return {
            rows:[],
            columns: [{label: "#", name: "item", sort: true},{label: "Servicio", name: "name"},{label: "Día inicio", name: "start_day"},{label: "Día fin", name: "end_day"},{label: "Valor", name: "value"},{label: "Estado",name: "status"},{label: "Opciones", name: "options"}],
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
            loadCreate: true,
            name_site:'',
            site_id:'',
            band_service:'create',
            service:'',
            start_day:'',
            end_day:'',
            price:'',
            service_id:'',
            service_opt:[],
            checkboxes:[],
            day_opt: [
                { name: 'Lunes', language: 'Lunes' },
                { name: 'Martes', language: 'Martes' },
                { name: 'Miércoles', language: 'Miércoles' },
                { name: 'Jueves', language: 'Jueves' },
                { name: 'Viernes', language: 'Viernes' },
                { name: 'Sábado', language: 'Sábado' },
                { name: 'Domingo', language: 'Domingo' },
                { name: 'Todos los días', language: 'Todos los días' },
                { name: 'Entre semana', language: 'Entre semana' },
                { name: 'Los fines de semana', language: 'Los fines de semana' },
            ],
        }
    },
    methods: {
        getServiceSite: function (){
            this.rows = [];
            let count = 1;
            let checkboxes_aux = [];
            let category_aux = [];
            axios.get('service-site-resource?Q=0&site_id='+this.site_id).then(response => {
                let data = response.data;
                for(let i in data){
                    let status_aux = response.data[i].state == 'active' ? 'activo': 'inactivo';
                    let arr = [];
                    let formData = {
                        status: status_aux,
                        id: response.data[i].id
                    };
                    arr.push(formData);
                    category_aux.push({"item": count++, "name": response.data[i].name,"start_day": response.data[i].start_day,"end_day": response.data[i].end_day,"value": response.data[i].value, "status": arr, "options": response.data[i].id});
                    checkboxes_aux.push(response.data[i].state == 'active' ? true : false);
                }
                this.rows = category_aux;
                this.checkboxes = checkboxes_aux;
            });
        },
        //Rules
        setServiceSite: function() {
            this.loadCreate = false;
            let formData = {
                service: this.service.id,
                start_day: this.start_day.name,
                end_day: this.end_day.name,
                price: this.price,
                site_id: this.site_id,
                id: this.service_id,
                band: this.band_service,
            };
            axios.post('/service-site-resource', formData).then((response) => {
                this.loadCreate = true;
                this.getServiceSite();
                this.reset();
                this.messageAlert('success','Correcto!','Servicio guardado con éxito!');
            }).catch((error) => {
                console.log(error);
                this.loadCreate = true;
            });
        },
        getServiceId: function (id){
            this.service_id = id;
            axios.get('service-site-resource/'+id+'/edit').then(response => {
                let data = response.data;
                this.service = {id:data.id_service, name:data.name};
                this.start_day = {id:data.id,name:data.start_day};
                this.end_day = {id:data.id,name:data.end_day};
                this.price = data.value;
            });
        },
        stateServiceSite: function(id, state){
            let formData = {
                id: id,
                state: state
            };
            axios.put('/service-site-resource/'+id, formData).then((response) => {
                //Success
                this.messageAlert('success', 'Correcto!', 'Estado actualizado');
                this.getServiceSite();

            }).catch((error) => {
                console.log(error.response);
            });
        },
        getServiceActive: function (){
            axios.get('service-site-resource?Q=1').then(response => {
                this.service_opt = [];
                let data = response.data;
                for (let i in data) {
                    this.service_opt.push({
                        "id": data[i].id,
                        "name": data[i].name,
                    });
                }
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
                    this.price = num;
                }
            }else{
                this.messageAlert('warning', 'Atención!', 'Solo se permiten números');
                if (index == 1){
                    this.price = this.price.replace(/[^\d\.]*/g,'');
                }
            }
        },
        removeLocal: function () {
            localStorage.removeItem('site_id');
            localStorage.removeItem('name_site');
            this.$router.push({path: '/home'});
        },
        reset: function () {
            this.service="";
            this.start_day="";
            this.end_day="";
            this.price="";
            this.band_service='create';
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
        VueBootstrap4Table,
        Multiselect
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
