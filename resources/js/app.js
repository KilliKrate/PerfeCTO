import Vue from 'vue'
import VueRouter from 'vue-router'
import Vuetify from './plugins/vuetify'

import 'vuetify/dist/vuetify.min.css'


import App from './views/App'
import Home from './views/HomePage'
import Companies from './views/CompaniesPage'
import Dashboard from './views/DashboardPage'
import Login from './views/LoginPage'
import About from './views/AboutPage'

Vue.use(Vuetify);
Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [{
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
            path: '/app',
            name: 'companies',
            component: Companies
        },
        {
            path: '/app/dashboard',
            name: 'dashboard',
            component: Dashboard
        },
        {
            path: '/app/about',
            name: 'about',
            component: About
        }
    ]
});

const app = new Vue({
    el: '#app',
    vuetify: Vuetify,
    components: {
        App
    },
    router
})
