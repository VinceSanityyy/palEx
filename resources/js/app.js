
require('./bootstrap');
window.Vue = require('vue').default;
import toastr from 'admin-lte/plugins/toastr/toastr.min.js'
import swal from 'admin-lte/plugins/sweetalert2/sweetalert2.min.js'
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
Vue.use(toastr)
Vue.use(Loading)


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('login',require('./components/Login.vue').default);
Vue.component('register',require('./components/Register.vue').default);

window.swal = swal;
window.toastr = require('toastr')

const app = new Vue({
    el: '#app',
});
