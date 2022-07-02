<template>
    <div>
        <div class="page-inner">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <template v-if="site_view">
                            <div class="card-header" style="background: #E7E7E7">
                                <div class="card-title">
                                    <template>
                                        <h2 class="clr-font"><b>Reseñas de los sitios</b></h2>
                                    </template>
                                </div>
                            </div>
                            <div class="card-body">
                                <vue-bootstrap4-table :rows="rows" :columns="columns" :config="config">
                                    <template slot="options" slot-scope="props">
                                        <b-button size="sm" class="btn-tble" v-b-modal.update-rol @click="getReviewId(props.cell_value, site_view=false, name_site= props.row.name) " title="Ver reseñas"><i class="fa fa-eye text-white"></i></b-button>
                                    </template>
                                </vue-bootstrap4-table>
                            </div>
                        </template>
                        <template v-else>
                            <div class="card-header" style="background: #E7E7E7">
                                <div class="card-title">
                                    <template>
                                        <div class="pull-right">
                                            <button class="btn" style="background: #555555; color: white" @click="site_view=true"><i class="fa fa-arrow-left"></i> Regresar </button>
                                        </div>
                                        <h2 class="clr-font"><b>Reseñas "{{name_site}}" </b></h2>
                                    </template>
                                </div>
                            </div>
                            <div class="card-body">
                                <vue-bootstrap4-table :rows="rows_review" :columns="columns_review" :config="config">
                                    <template slot="options" slot-scope="props">
                                        <b-button size="sm" class="btn-tble" @click="getReviewId(props.cell_value, site_view=false) " title="Ver reseñas"><i class="fa fa-eye text-white"></i></b-button>
                                    </template>
                                </vue-bootstrap4-table>
                            </div>
                        </template>

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
name: "Review",
    mounted() {
        this.getSiteReview();
    },
    data: function () {
        return {
            rows_review: [],
            rows: [],
            columns: [{label: "#", name: "item", sort: true}, {label: "Nombre sitio", name: "name"}, {label: "Nit",name: "nit", }, {label: "Teléfono", name: "phone"}, {label: "Dirección", name: "address"}, {label: "Opciones", name: "options"}],
            columns_review: [{label: "#", name: "item", sort: true}, {label: "Nombre persona", name: "name_person"}, {label: "Email",name: "email", }, {label: "Estrellas", name: "stars"}, {label: "Descripción", name: "description"}, {label: "Fecha creación", name: "created_at"}],
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
            site_view: true,
            name_site: '',
        }
    },
    methods: {
        getSiteReview: function () {
            axios.get('/review-resource?Q=0').then(response => {
                this.rows = [];
                let site_aux = [];
                let count = 1;
                for(let i in response.data){
                    site_aux.push({"item": count++, "name": response.data[i].name,"nit": response.data[i].nit, "phone": response.data[i].phone,"address": response.data[i].address, "options": response.data[i].id});
                }
                this.rows = site_aux;
            }).catch(e => {
                console.log(e.response);
            });
        },
        getReviewId: function (id) {
            axios.get('/review-resource?Q=1&id='+id).then(response => {
                this.rows_review = [];
                let site_aux = [];
                let count = 1;
                for(let i in response.data){
                    site_aux.push({"item": count++, "name_person": response.data[i].name_person,"email": response.data[i].email, "stars": response.data[i].stars,"description": response.data[i].description, "created_at": response.data[i].created_at});
                }
                this.rows_review = site_aux;
            }).catch(e => {
                console.log(e.response);
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
