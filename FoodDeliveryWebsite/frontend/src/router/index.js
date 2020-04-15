import Vue from 'vue';
import VueRouter from 'vue-router'

import Login from '@/views/Login'
import Home from '@/views/Home'
import Promo from '@/views/Promo'


Vue.use(VueRouter);

const routes = [
    {
        path : '/',
        name : 'Login',
        component : Login
    },
    {
        path :'/home',
        name : 'Home',
        component : Home
    },
    {
        path :'/promo',
        name : 'Promo',
        component : Promo
    },
  
]

const router = new VueRouter({
    mode : 'history',
    base : process.env.BASE_URL,
    routes
})

export default router