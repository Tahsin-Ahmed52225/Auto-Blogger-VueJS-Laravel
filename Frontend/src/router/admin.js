
import Layout from '../views/Dashboard/Admin/Layout.vue'

import { authGuard, redirectIfAuthenticated } from '../helper'

export default [
    {
      path: '/admin/dashboard',
      component: Layout,
    }, 
]