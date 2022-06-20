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
                                    <h2 class="clr-font"><b>Categorias</b></h2>
                                </template>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row" v-if="$can('Crear categorias')">
                                <div class="offset-md-3 offset-lg-3 col-md-6 col-lg-6">
                                    <b-form @submit.prevent="setCategory()" autocomplete="off">
                                        <b-form-group label="Nombre categoria:">
                                            <b-form-input v-model="name" required></b-form-input>
                                        </b-form-group>
                                        <div class="row form-group mt-3">
                                            <div class="col-md-12 col-lg-12 col-sm-12 text-center" v-if="loadCreate">
                                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                                                <button type="reset" id="btCan" @click="band='create',id=''" class="btn btn-danger"><i class="fas fa-window-close"></i> Cancelar</button>
                                            </div>
                                            <div class="col-md-12 col-lg-12 col-sm-12 text-center" v-else>
                                                <i class="fa fa-spinner fa-spin"></i> Guardando...
                                            </div>
                                        </div>
                                    </b-form>
                                </div>
                            </div>
                            <br>
                            <vue-bootstrap4-table :rows="rows" :columns="columns" :config="config">
                                <template slot="options" slot-scope="props">
                                    <b-button size="sm" class="btn-tble" href="#category" v-b-modal.update-rol @click="getCategoryId(props.cell_value), band='update'" title="Editar Categoria"><i class="fa fa-edit text-white"></i></b-button>
                                </template>
                                <template slot="status" slot-scope="props">
                                    <div class="switch">
                                        <label v-if="props.cell_value[0].status == 'activo'" class="switch">
                                            <input type="checkbox" v-model="checkboxes[props.row.vbt_id-1]" @change="stateCategory(props.row.options, 'inactive','Inactivo')" name="check-button" checked>
                                            <span class="lever"></span><br>
                                            Activo
                                        </label>
                                        <label v-else-if="props.cell_value[0].status == 'inactivo'" class="switch">
                                            <input type="checkbox" v-model="checkboxes[props.row.vbt_id-1]" @change="stateCategory(props.row.options, 'active', 'Activo')" name="check-button">
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

export default {
name: "Category",
    mounted() {
        this.getCategory()
    },
    data: function () {
        return {
            rows:[],
            columns: [{label: "#", name: "item", sort: true},{label: "Categoria", name: "name"},{label: "Estado",name: "status"},{label: "Opciones", name: "options"}],
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
            name:'',
            id:'',
            band:'create',
            checkboxes:[],
        }
    },
    methods: {
        getCategory: function (){
            this.rows = [];
            let count = 1;
            let checkboxes_aux = [];
            let category_aux = [];
            axios.get('category-resource').then(response => {
                let data = response.data;
                for(let i in data){
                    let status_aux = response.data[i].state == 'active' ? 'activo': 'inactivo';
                    let arr = [];
                    let formData = {
                        status: status_aux,
                        id: response.data[i].id
                    };
                    arr.push(formData);
                    category_aux.push({"item": count++, "name": response.data[i].name, "status": arr, "options": response.data[i].id});
                    checkboxes_aux.push(response.data[i].state == 'active' ? true : false);
                }
                this.rows = category_aux;
                this.checkboxes = checkboxes_aux;
            });
        },
        setCategory: function() {
            this.loadCreate = false;
            let formData = {
                name: this.name,
                id: this.id,
                band: this.band,
            };
            axios.post('/category-resource', formData).then((response) => {
                this.name="";
                this.id='';
                this.band='create';
                this.loadCreate = true;
                if(response.data == true){
                    this.messageAlert('warning','Atención!','Esta categoria ya existe!');
                }else{
                    this.getCategory();
                    this.messageAlert('success','Correcto!','Categoria guardada con éxito!');
                }
            }).catch((error) => {
                console.log(error);
                this.loadCreate = true;
            });
        },
        getCategoryId: function (id){
            this.id=id;
            axios.get('category-resource/'+id+'/edit').then(response => {
                let data = response.data;
                this.name = data.name;
            });
        },
        stateCategory: function(id, state){
            let formData = {
                id: id,
                state: state
            };
            axios.put('/category-resource/'+id, formData).then((response) => {
                //Success
                this.messageAlert('success', 'Correcto!', 'Estado actualizado');
                this.getCategory();
            }).catch((error) => {
                console.log(error.response);
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
