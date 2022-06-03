import Vue from 'vue';
import VueRouter from 'vue-router';

//Inicio
import IndexHome from './components/Home';
import Prueba from "./components/Prueba";
import User from "./components/Security/User";
import Roles from "./components/Security/Roles";
import Category from "./components/Category/Category";
import Service from "./components/Service/Service";
import Rule from "./components/Site/Rule";
import ServiceSite from "./components/Site/ServiceSite";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        //Inicio
        { path: '/home', name: 'home', component: IndexHome },
        { path: '/prueba', name: 'prueba', component: Prueba },
        { path: '/user', name: 'user', component: User },
        { path: '/roles', name: 'roles', component: Roles },
        { path: '/category', name: 'category', component: Category },
        { path: '/service', name: 'service', component: Service },
        { path: '/rule', name: 'rule', component: Rule },
        { path: '/serviceSite', name: 'serviceSite', component: ServiceSite },
    ]
});

export default router;
