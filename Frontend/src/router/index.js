import { createRouter, createWebHistory } from 'vue-router'
import webRoutes from './web.js'
import adminRoutes from './admin.js'
import userRoutes from './user.js'

// Helper function 
import { authGuard, redirectIfAuthenticated } from '../helper'



const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    ...webRoutes,
    ...adminRoutes,
    ...userRoutes,
  ]
})

export default router
