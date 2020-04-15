import Vue from 'vue';
import VueRouter from 'vue-router'

import Login from '@/views/Login'
import Home from '@/views/Home'
import MenuPasta from '@/views/MenuPasta'

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
        path :'/menupasta',
        name : 'MenuPasta',
        component : MenuPasta
    }
]

const router = new VueRouter({
    mode : 'history',
    base : process.env.BASE_URL,
    routes
})

export default router