<template>
    <div>
        <div class="page-inner">
            <div class="row">
                <div class="col">
                    <a name="category"></a>
                    <div class="card">
                        <div class="card-header" style="background: #E7E7E7">
                            <div class="card-title">
                                <template>
                                    <div class="row">
                                        <div class="pull-left col-2" v-if="viewImg">
                                            <button class="btn" style="background: #555555; color: white" @click="removeLocal(), getImgPlan()"><i class="fa fa-arrow-left"></i> Regresar </button>
                                        </div>
                                        <div class="pull-left col-2" v-if="!viewImg">
                                            <button class="btn" style="background: #555555; color: white" @click="viewImg=true"><i class="fa fa-arrow-left"></i> Regresar </button>
                                        </div>
                                        <h2 class="clr-font justify-content-center col-7"><b>Imagenes de {{name_plan}}</b></h2>
                                        <div class="pull-right col-3" v-if="viewImg">
                                            <button class="btn" style="background: #03B8AD; color: white" @click="createFile()"> Agregar imagenes <i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>

                                </template>
                            </div>
                        </div>
                        <div class="card-body">
                            <template v-if="viewImg">
                                <vue-bootstrap4-table :rows="rows" :columns="columns" :config="config">
                                    <template slot="options" slot-scope="props">
                                        <b-button size="sm" class="btn-tble" @click="openImg(props.row.name)" title="Ver imagen"><i class="fa fa-eye text-white"></i></b-button>
                                        <b-button size="sm" class="btn-danger" @click="showMsgBoxTwo(),img_id=props.cell_value" title="Eliminar imagen"><i class="fa fa-trash text-white"></i></b-button>
                                    </template>
                                    <template slot="status" slot-scope="props">
                                        <div class="switch">
                                            <label v-if="props.cell_value[0].status == 'activo'" class="switch">
                                                <input type="checkbox" v-model="checkboxes[props.row.vbt_id-1]" @change="stateImg(props.row.options, 'inactive','Inactivo')" name="check-button" checked>
                                                <span class="lever"></span><br>
                                                Activo
                                            </label>
                                            <label v-else-if="props.cell_value[0].status == 'inactivo'" class="switch">
                                                <input type="checkbox" v-model="checkboxes[props.row.vbt_id-1]" @change="stateImg(props.row.options, 'active', 'Activo')" name="check-button">
                                                <span class="lever"></span><br>
                                                Inactivo
                                            </label>
                                        </div>
                                    </template>
                                </vue-bootstrap4-table>
                            </template>
                            <template v-else>
                                <div class="row">
                                    <div class="offset-1 col-md-10 col-lg-10">
                                        <b-form @submit.prevent="setImg()" autocomplete="off">
                                            <div class="row">
                                                <div class="col">
                                                    <b-form-group id="fieldset-file1" label-class="font-weight-bold" class="mt-3" label="Agregar imagenes del sitio:">
                                                        <input type="file" class="fileinputImage" v-on:change="changePhoto" multiple required>
                                                    </b-form-group>
                                                </div>
                                            </div>
                                            <div class="row form-group mt-3">
                                                <div class="col-md-12 col-lg-12 col-sm-12 text-center" v-if="loadCreate">
                                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                                                </div>
                                                <div class="col-md-12 col-lg-12 col-sm-12 text-center" v-else>
                                                    <i class="fa fa-spinner fa-spin"></i> Guardando...
                                                </div>
                                            </div>
                                        </b-form>
                                    </div>
                                </div>

                            </template>

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

export default {
    name: "ImgPlan",
    mounted() {
        this.plan_id = JSON.parse(localStorage.getItem('plan_id'));
        this.name_plan = JSON.parse(localStorage.getItem('name_plan'));
        this.getImgPlan();
    },
    data: function () {
        return {
            rows:[],
            columns: [{label: "#", name: "item", sort: true},{label: "Imagen", name: "name"},{label: "Estado",name: "status"},{label: "Opciones", name: "options"}],
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
            viewImg: true,
            viewButton: true,
            loadCreate: true,
            name_plan:'',
            name_rule:'',
            plan_id:'',
            img_id:'',
            boxTwo: '',
            band:'create',
            checkboxes:[],
            file_img:[],
        }
    },
    methods: {
        getImgPlan: function () {
            this.rows = [];
            let count = 1;
            let checkboxes_aux = [];
            let category_aux = [];
            axios.get('image-plan-resource?Q=0&plan_id=' + this.plan_id).then(response => {
                let data = response.data;
                for (let i in data) {
                    let status_aux = response.data[i].state == 'active' ? 'activo' : 'inactivo';
                    let arr = [];
                    let formData = {
                        status: status_aux,
                        id: response.data[i].id
                    };
                    arr.push(formData);
                    category_aux.push({
                        "item": count++,
                        "name": response.data[i].name,
                        "status": arr,
                        "options": response.data[i].id
                    });
                    checkboxes_aux.push(response.data[i].state == 'active' ? true : false);
                }
                this.rows = category_aux;
                this.checkboxes = checkboxes_aux;
            });
        },
        setImg: function() {
            this.loadCreate = false;
            let formData = new FormData;
            for (let i in this.file_img) {
                formData.append('file[' + i + ']', this.file_img[i]);
            }
            formData.append('plan_id', this.plan_id);
            const config = {
                headers: {'content-type': 'multipart/form-data'}
            };
            axios.post('/image-plan-resource', formData, config).then(response => {
                this.file_img=[];
                this.getImgPlan();
                this.messageAlert('success', 'Correcto!', 'Imagenes guardadas exitosamente!');
                this.loadCreate = true;
                this.viewImg=true;
                this.viewButton=true;
            }).catch(e => {
                console.log(e);
                this.loadCreate = true;
            });
        },
        openImg: function(name){
            window.open('/soportes/img_plan/'+name);
        },
        showMsgBoxTwo() {
            this.boxTwo = ''
            this.$bvModal.msgBoxConfirm('La imagen será eliminada de los registros.', {
                title: '¿Estás seguro?',
                size: 'sm',
                buttonSize: 'sm',
                okVariant: 'danger',
                okTitle: 'SI',
                cancelTitle: 'NO',
                footerClass: 'p-2',
                hideHeaderClose: true,
                centered: true
            })
                .then(value => {
                    this.boxTwo = value;
                    if(this.boxTwo!=false){
                        this.deleteImg();
                    }
                })
                .catch(err => {
                    // An error occurred
                })
        },
        deleteImg: function() {
            axios.delete('/image-plan-resource/' + this.img_id).then((response) => {
                this.getImgPlan();
                this.messageAlert('success', 'Correcto!', 'Imagen eliminada exitosamente.');
            }).catch((error) => {
                console.log(error.response);
            });
        },
        stateImg: function(id, state){
            let formData = {
                id: id,
                state: state
            };
            axios.put('/image-plan-resource/'+id, formData).then((response) => {
                //Success
                this.messageAlert('success', 'Correcto!', 'Estado actualizado');
                this.getImgPlan();

            }).catch((error) => {
                console.log(error.response);
            });
        },
        removeLocal: function () {
            localStorage.removeItem('plan_id');
            localStorage.removeItem('name_plan');
            this.$router.push({path: '/plans'});
        },
        changePhoto: function(e) {
            for (let i in e.target.files){
                this.file_img.push(e.target.files[i]);
            }
        },
        createFile:function (){
            this.viewImg=false;
            this.viewButton=false;
            this.file_img=[];
            setTimeout(function() {
                $(".fileinputImage").fileinput({
                    'overwriteInitial': false,
                    'allowedFileExtensions': ['png','jpg','jpeg'],
                    'showUpload': false,
                    'theme': 'fas',
                    'previewFileType': 'any',
                    'maxFileCount': 10,
                    'language': 'es',
                    'previewFileIcon': '<i class="fas fa-file"></i>',
                });
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
