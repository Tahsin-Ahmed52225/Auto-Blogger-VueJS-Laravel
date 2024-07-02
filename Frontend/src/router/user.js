
import Layout from '../views/Dashboard/User/Layout.vue'
import Dashboard from '../views/Dashboard/User/Pages/Dashboard.vue'
import ViewPosts from '../views/Dashboard/User/Pages/ViewPosts.vue'
import AddPost from '../views/Dashboard/User/Pages/AddPost.vue'
import Categoires from '../views/Dashboard/User/Pages/Categoires.vue'

// Helper function 
import { authGuard } from '../helper'

export default [
    {
      path: '/user',
      component: Layout,
      children: [
          {
            path: 'dashboard',
            name: 'dashboard',
            beforeEnter: authGuard,
            component:  Dashboard
        },
          {
            path: 'posts',
            name: 'posts',
            beforeEnter: authGuard,
            children: [
              {
                  path: 'view',
                  name: 'view',
                  beforeEnter: authGuard,
                  component:  ViewPosts
              },
              {
                  path: 'add',
                  name: 'add',
                  beforeEnter: authGuard,
                  component:  AddPost
              },

            ],
        },
            {
            path: 'categoires',
            name: 'categoires',
            beforeEnter: authGuard,
            component:  Categoires
        },
      ]
    }, 
]