
require('./bootstrap');
window.Vue = require('vue').default;
import toastr from 'admin-lte/plugins/toastr/toastr.min.js'
import swal from 'admin-lte/plugins/sweetalert2/sweetalert2.min.js'
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import VueRouter from 'vue-router'
import VueAlertify from 'vue-alertify';
Vue.use(toastr)
Vue.use(Loading)
Vue.use(VueRouter)
Vue.use(VueAlertify,{
    movable: false,
    glossary: {
      title: 'Confirm',
      ok: 'OK',
      cancel: 'Cancel',
    },
  });

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('login',require('./components/Login.vue').default);
Vue.component('register',require('./components/Register.vue').default);
Vue.component('vendors',require('./components/Vendor.vue').default);
Vue.component('home',require('./components/Home.vue').default);
Vue.component('home',require('./components/Dashboard.vue').default);
window.swal = swal;
window.toastr = require('toastr')

const routes = [
    { path: '/vendors', component: require('./components/Vendor.vue').default },
    { path: '/home', component: require('./components/Home.vue').default },
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/feeds', component: require('./components/Feeds.vue').default },
  ]

const router = new VueRouter({
    mode: 'history',
    routes
  })

const app = new Vue({
    el: '#app',
    router,
});
