require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import VueNotifications from 'vue-notifications';
import toastr from 'toastr';
import 'toastr/build/toastr.min.css';


function toast ({title, message, type, timeout, cb}) {
    if (type === VueNotifications.types.warn) type = 'warning'
    return toastr[type](message, title, {timeOut: timeout})
}

const options = {
    success: toast,
    error: toast,
    info: toast,
    warn: toast
};

Vue.use(VueNotifications, options)
Vue.use(VueRouter);


///Importing views from "components"

import App from './components/App'
import Home from './components/Home'
import Login from './components/Login'
import Register from './components/Register'
import SingleProduct from './components/SingleProduct'
import Checkout from './components/Checkout'
import Confirmation from './components/Confirmation'
import UserBoard from './components/UserBoard'
import Admin from './components/Admin'
import CategoryProducts from './components/CategoryProducts'

const router = new VueRouter({
    mode: 'history',
    routes: [

        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        },
        {
            path: '/products/:id',
            name: 'single-products',
            component: SingleProduct
        },
        ///
        ///
        {
            path: '/categories/:id',
            name: 'category-products',
            component: CategoryProducts
        },
        ///
        ///

        {
            path: '/confirmation',
            name: 'confirmation',
            component: Confirmation
        },
        {
            path: '/checkout',
            name: 'checkout',
            component: Checkout,
            props: (route) => ({ pid: route.query.pid })
        },
        {
            path: '/dashboard',
            name: 'userboard',
            component: UserBoard,
            meta: {
                requiresAuth: true,
                is_user: true
            }
        },
        {
            path: '/admin/:page',
            name: 'admin-pages',
            component: Admin,
            meta: {
                requiresAuth: true,
                is_admin: true
            }
        },
        {
            path: '/admin',
            name: 'admin',
            component: Admin,
            meta: {
                requiresAuth: true,
                is_admin: true
            }
        },

    ]
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (localStorage.getItem('another-shop.jwt') == null) {
            next({
                path: '/login',
                params: { nextUrl: to.fullPath }
            })
        } else {
            let user = JSON.parse(localStorage.getItem('another-shop.user'));
            if (to.matched.some(record => record.meta.is_admin)) {
                if (user.is_admin == 1) {
                    next()
                }
                else {
                    next({ name: 'userboard' })
                }
            }
            else if (to.matched.some(record => record.meta.is_user)) {
                if (user.is_admin == 0) {
                    next()
                }
                else {
                    next({ name: 'admin' })
                }
            }
            next()
        }
    } else {
        next()
    }
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
