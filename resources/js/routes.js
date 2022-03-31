import Vue from 'vue';
import VueRouter from 'vue-router';

//Inicio
import IndexHome from './components/Home';
import Prueba from "./components/Prueba";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        //Inicio
        { path: '/home', name: 'home', component: IndexHome },
        { path: '/prueba', name: 'prueba', component: Prueba },
    ]
});

export default router;
