
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


// Layouts
import SuperAdminLayout from './layouts/SuperAdminLayout.vue';
import VendorAdminLayout from './layouts/VendorAdminLayout.vue';
import CustomerLayout from './layouts/CustomerLayout.vue';

// Admin Pages
import AdminDashboard from './pages/backside/admin/index.vue';
import AdminUsers from './pages/backside/admin/users.vue';
import AdminVendors from './pages/backside/admin/vendors.vue';
import AdminFeeds from './pages/backside/admin/feeds.vue';


// Vendor Pages
import VendorDashboard from './pages/backside/vendor/index.vue';
import VendorOrders from './pages/backside/vendor/orders.vue';
import VendorProducts from './pages/backside/vendor/products.vue';

// Customer Pages
import CustomerProfile from './pages/frontside/customer/index.vue';
import CustomerOrders from './pages/frontside/customer/orders.vue';
import CustomerFeeds from './pages/frontside/customer/feeds.vue';

// Public Pages
import ProductsPage from './pages/frontside/Products.vue';
import HomePage from './pages/frontside/Home.vue';
// import productscopy from './pages/customer/productscopy.vue';


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
            {
                path: 'feeds',
                name: 'customerFeeds',
                components: {
                    helper: CustomerFeeds
                }
            },
        ],
    },
    {
        path: '/',
        component: CustomerLayout,
        children: [
            {
                path: '',
                name: 'HomePage',
                component: HomePage
            },
        ],
    },
    {
        path: '/products',
        component: CustomerLayout,
        children: [
            {
                path: '',
                name: 'ProductsPage',
                component: ProductsPage
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
