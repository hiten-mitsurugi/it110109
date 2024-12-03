import { createRouter, createWebHistory } from 'vue-router';
import Welcome from '@/views/Welcome.vue';  // Import your Welcome page
import Login from '@/views/Login.vue';      // Import your Login page
import Register from '@/views/Register.vue';
import AdminHome from '@/views/AdminHome.vue';
import UserHome from '@/views/UserHome.vue';




const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',  
      name: 'Welcome',  
      component: Welcome,  
    },
    {
      path: '/login', 
      name: 'login',  
      component: Login, 
    },
    {
      path: '/register',  
      name: 'register',  
      component: Register,  
    },
    {
      path: '/admin-home',  
      name: 'AdminHome',  
      component: AdminHome,  
    },
    {
      path: '/user-home',  
      name: 'UserHome',  
      component: UserHome,  
    },
  
  ],
});

export default router;
