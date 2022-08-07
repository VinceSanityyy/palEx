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
import VendorChat from './pages/backside/vendor/chat.vue';
import VendorSettings from './pages/backside/vendor/settings.vue';

// Customer Pages
import CustomerProfile from './pages/frontside/customer/index.vue';
import CustomerOrders from './pages/frontside/customer/orders.vue';
import CustomerOrdersDetails from './pages/frontside/customer/orders_id.vue';
import CustomerFeeds from './pages/frontside/customer/feeds.vue';
import CustomerChat from './pages/frontside/customer/chat.vue';
import CustomerCart from './pages/frontside/customer/cart.vue';

// Public Pages
import ProductsPage from './pages/frontside/Products.vue';
import ProductsIDPage from './pages/frontside/Products_id.vue';
import HomePage from './pages/frontside/Home.vue';
import NotFound from './pages/frontside/NotFound.vue';
import StoreProfile from './pages/frontside/store/vendor_id.vue';
import TestPage from './pages/frontside/test.vue';
// import productscopy from './pages/customer/productscopy.vue';

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
            {
                path: 'chat',
                name: 'ven-chat',
                components: {
                    helper: VendorChat
                }
            },
            {
                path: 'chat/:conversation_id',
                name: 'ven-chat-id',
                components: {
                    helper: VendorChat
                }
            },
            {
                path: 'settings',
                name: 'vendor-settings',
                components: {
                    helper: VendorSettings
                }
            }
        ],
    },
    {
        path: '/customer',
        component: CustomerLayout,
        children: [
            {
                path: '',
                name: 'cus',
                component: CustomerProfile
            },
            {
                path: 'orders',
                name: 'cus-orders',
                components: {
                    helper: CustomerOrders
                }
            },

            {
                path: 'orders/:order_id',
                name: 'cus-orders-order_id',
                components: {
                    helper: CustomerOrdersDetails
                }
            },


            {
                path: 'feeds',
                name: 'cus-feeds',
                components: {
                    helper: CustomerFeeds
                }
            },
            {
                path: 'chat',
                name: 'cus-chat',
                components: {
                    helper: CustomerChat
                }
            },
            {
                path: 'chat/:conversation_id',
                name: 'cus-chat-id',
                components: {
                    helper: CustomerChat
                }
            },
            {
                path: 'cart',
                name: 'cus-cart',
                components: {
                    helper: CustomerCart
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
                name: 'home',
                component: ProductsPage
            },
        ],
    },
    {
        path: '/home',
        component: CustomerLayout,
        children: [
            {
                path: '',
                name: 'home',
                component: ProductsPage
            },
        ],
    },
    {
        path: '/products',
        component: CustomerLayout,
        children: [
            {
                path: '',
                name: 'prod',
                component: ProductsPage
            },
            {
                path: ':product_id',
                name: 'prod-id',
                components: {
                    helper: ProductsIDPage
                }
            },
        ],
    },
    {
        path: '/store',
        component: CustomerLayout,
        children: [
            {
                path: ':vendor_id',
                name: 'vendor-id',
                component: StoreProfile
            },
        ],
    },
    {
        path: '/test',
        component: CustomerLayout,
        children: [
            {
                path: '',
                name: 'test',
                component: TestPage
            },
        ],
    },

    {
        path: '*',
        component: NotFound
    }
]


export default routes
