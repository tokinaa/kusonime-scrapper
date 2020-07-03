import Vue from 'vue'
import VueRouter from 'vue-router'

import Home from './views/Home'
import Grabber from './views/Grabber'

Vue.use(VueRouter)

const router = new VueRouter({
    mode : 'history',
    routes : [
        {
            path : '/',
            name : 'home',
            component : Home
        },
        {
            path : '/grab',
            name : 'grabber',
            component : Grabber
        }
    ]
})

export default router