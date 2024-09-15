import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/HomePage.vue'
import Login from '../components/Login.vue'
import Dashboard from '../components/LogisticsDashboard.vue'
import UserManagement from '../views/UserManagement.vue'
import OrderTracking from '../views/OrderTracking.vue'
import PackageManagement from '../views/PackageManagement.vue'
import Inventory from '../views/Inventory.vue'
import DeliveryServices from '../views/DeliveryServices.vue'
import PackageCreation from '../views/PackageCreation.vue'
import MyDeliveries from '../views/MyDeliveries.vue'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/dashboard',
    name: 'Dashboard',
    component: Dashboard,
    // meta: { requiresAuth: true }
  },
  {
    path: '/user-management',
    name: 'UserManagement',
    component: UserManagement,
    meta: { requiresAuth: true }
  },
  {
    path: '/order-tracking',
    name: 'OrderTracking',
    component: OrderTracking,
    meta: { requiresAuth: true }
  },
  {
    path: '/package-management',
    name: 'PackageManagement',
    component: PackageManagement,
    meta: { requiresAuth: true }
  },
  {
    path: '/inventory',
    name: 'Inventory',
    component: Inventory,
    meta: { requiresAuth: true }
  },
  {
    path: '/delivery-services',
    name: 'DeliveryServices',
    component: DeliveryServices,
    meta: { requiresAuth: true }
  },
  {
    path: '/package-creation',
    name: 'PackageCreation',
    component: PackageCreation,
    meta: { requiresAuth: true }
  },
  {
    path: '/my-deliveries',
    name: 'MyDeliveries',
    component: MyDeliveries,
    meta: { requiresAuth: true }
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

router.beforeEach((to, from, next) => {
  const isLoggedIn = !!localStorage.getItem('userToken'); // Example check for user token in localStorage
  if (to.matched.some(record => record.meta.requiresAuth) && !isLoggedIn) {
    next('/login')
  } else {
    next()
  }
})

export default router