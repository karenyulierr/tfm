import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue'

//Route information for vue router
import router from './routes.js';

import App from './components/App.vue';

import Permissions from './mixins/Permissions';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

Vue.mixin(Permissions);
Vue.use(BootstrapVue);
Vue.use(VueSweetalert2);


const app = new Vue({
    el: '#app',
    router,
    render: h => h(App)
});

export default app;
