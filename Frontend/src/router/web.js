import Layout from '../views/Website/Layout.vue'
import Home from '../views/Website/Pages/Home.vue'
import About from '../views/Website/Pages/About.vue'
import Login from '../views/Website/Auth/Login.vue'
import Register from '../views/Website/Auth/Register.vue'
import ForgetPassword from '../views/Website/Auth/ForgetPassword.vue'

// Helper function 
import { authGuard, redirectIfAuthenticated } from '../helper'


export default [
    {
      path: '/',
      component: Layout,
      children: [
        {
          path: '/',
          name:'home',
          component:  Home
        },
        {
          path: '/about',
          name:'about',
          component:  About
        },
        {
          path: '/login',
          name: 'login',
          beforeEnter: redirectIfAuthenticated,
          component: Login
        },
        {
          path: '/register',
          name: 'register',
          beforeEnter: redirectIfAuthenticated,
          component: Register
        },
        {
          path: '/forget-password',
          name: 'forget-password',
          beforeEnter: redirectIfAuthenticated,
          component: ForgetPassword
        },
      ]
    }
]