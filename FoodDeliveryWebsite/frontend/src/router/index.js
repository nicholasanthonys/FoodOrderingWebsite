import Vue from 'vue';
import VueRouter from 'vue-router'

import Login from '@/views/Login'
import Register from '@/views/Register'
import Home from '@/views/Home'
import Promo from '@/views/Promo'
import Menu from '@/views/Menu'
import DetailMenu from '@/views/DetailMenu'
import Profile from '@/views/Profile'
import MyCart from '@/views/MyCart'
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
        component : Menu
    },
    {
        path : '/menusteak',
        name : 'Menu Steak',
        component : Menu
    },
    {
        path : '/menupizza',
        name : 'Menu Pizza',
        component : Menu
    },
    {
        path : '/menurice',
        name : 'Menu Rice',
        component : Menu
    },
    {
        path : '/menusoup',
        name : 'Menu Soup',
        component : Menu
    },
    {
        path : '/menusalad',
        name : 'Menu Steak',
        component : Menu
    },
    {
        path : '/menudrinks',
        name : 'Menu Steak',
        component : Menu
    },
    {
        path :'/detailmenu/:menuID',
        name : 'Detail Menu',
        component : DetailMenu
    },
    {
        path :'/profile',
        name : 'Profile',
        component : Profile
    },
    {
        path :'/mycart',
        name : 'My Cart',
        component : MyCart
    }
]

const router = new VueRouter({
    mode : 'history',
    base : process.env.BASE_URL,
    routes
})

export default router