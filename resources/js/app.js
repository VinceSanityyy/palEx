
require('./bootstrap');
window.Vue = require('vue').default;
import toastr from 'admin-lte/plugins/toastr/toastr.min.js'
import swal from 'admin-lte/plugins/sweetalert2/sweetalert2.min.js'
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import VueRouter from 'vue-router'
import VueAlertify from 'vue-alertify';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import routes from './routes'
// import store from './store'

import VueEvents from 'vue-events';
Vue.use(VueEvents)

Vue.use(ElementUI);
Vue.use(toastr)
Vue.use(Loading)
Vue.use(VueRouter)
Vue.use(VueAlertify, {
    movable: false,
    glossary: {
        title: 'Confirm',
        ok: 'OK',
        cancel: 'Cancel',
    },
});

Vue.component('login', require('./pages/frontside/Login.vue').default);
Vue.component('register', require('./pages/frontside/Register.vue').default);
// Vue.component('AddToCartModal', require('./modals/AddToCartModal.vue').default);

window.swal = swal;
window.toastr = require('toastr')

const router = new VueRouter({
    mode: 'history',
    routes
})

const app = new Vue({
    el: '#app',
    router,
});
