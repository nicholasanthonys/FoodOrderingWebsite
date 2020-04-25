import Vue from 'vue';
import VueRouter from 'vue-router'

import Login from '@/views/Login'
import Register from '@/views/Register'
import Home from '@/views/Home'
import Promo from '@/views/Promo'
import MenuPasta from '@/views/MenuPasta'
import DetailMenu from '@/views/DetailMenu'
import VueSession from 'vue-session'

Vue.use(VueRouter);
Vue.use(VueSession);

const routes = [
    {
        path : '/',
        name : 'Login',
        component : Login
    },
       {
        path : '/register',
        name : 'Register',
        component : Register
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
    {
        path : '/menupasta',
        name : 'Menu Pasta',
        component : MenuPasta
    },
    {
        path :'/detailmenu/:menuID',
        name : 'Detail Menu',
        component : DetailMenu
    }
]

const router = new VueRouter({
    mode : 'history',
    base : process.env.BASE_URL,
    routes
})

export default router