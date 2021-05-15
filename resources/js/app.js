
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
Vue.use(VueAlertify, {
    movable: false,
    glossary: {
        title: 'Confirm',
        ok: 'OK',
        cancel: 'Cancel',
    },
});

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('login', require('./components/Login.vue').default);
Vue.component('register', require('./components/Register.vue').default);
Vue.component('vendors', require('./components/Vendor.vue').default);
// Vue.component('home', require('./components/Home.vue').default);
Vue.component('home', require('./components/Dashboard.vue').default);


// Layouts
import SuperAdminLayout from './layouts/SuperAdminLayout.vue';
import VendorAdminLayout from './layouts/VendorAdminLayout.vue';
import CustomerLayout from './layouts/CustomerLayout.vue';

// Admin Pages
import AdminDashboard from './pages/admin/index.vue';
import AdminUsers from './pages/admin/users.vue';
import AdminVendors from './pages/admin/vendors.vue';
import AdminFeeds from './pages/admin/feeds.vue';


// Vendor Pages
import VendorDashboard from './pages/vendor/index.vue';
import VendorOrders from './pages/vendor/orders.vue';
import VendorProducts from './pages/vendor/products.vue';

// Customer Pages
import CustomerProfile from './pages/customer/index.vue';
import CustomerOrders from './pages/customer/orders.vue';




window.swal = swal;
window.toastr = require('toastr')

const routes = [
    // { path: '/vendors', component: require('./components/Vendor.vue').default },
    // { path: '/home', component: require('./components/Home.vue').default },
    // { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    {
        path: '/admin',
        component: SuperAdminLayout,
        children: [
            {
                path: '',
                name: 'AdminDashboard',
                component: AdminDashboard
            },
            {
                path: 'users',
                name: 'admin-feeds',
                components: {
                    helper: AdminUsers
                }
            },
            {
                path: 'feeds',
                name: 'admin-feeds',
                components: {
                    helper: AdminFeeds
                }
            },
            {
                path: 'vendors',
                name: 'admin-vendors',
                components: {
                    helper: AdminVendors
                }
            },
        ],
    },
    {
        path: '/vendor',
        component: VendorAdminLayout,
        children: [
            {
                path: '',
                name: 'vendor-dashboard',
                component: VendorDashboard
            },
            {
                path: 'orders',
                name: 'vendor-orders',
                components: {
                    helper: VendorOrders
                }
            },
            {
                path: 'products',
                name: 'vendor-products',
                components: {
                    helper: VendorProducts
                }
            },
        ],
    },
    {
        path: '/customer',
        component: CustomerLayout,
        children: [
            {
                path: '',
                name: 'CustomerProfile',
                component: CustomerProfile
            },
            {
                path: 'orders',
                name: 'CustomerOrders',
                components: {
                    helper: CustomerOrders
                }
            },
        ],
    },
]

const router = new VueRouter({
    mode: 'history',
    routes
})

const app = new Vue({
    el: '#app',
    router,
});
