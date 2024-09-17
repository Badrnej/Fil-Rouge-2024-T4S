<template>
  <div :class="{ 'dark': darkMode }">
    <div class="flex h-screen bg-gray-100 dark:bg-gray-900">
      <!-- Sidebar -->
      <aside class="w-64 bg-white dark:bg-gray-800 shadow-md">
        <div class="p-4">
          <h1 class="text-2xl font-bold text-orange-400 dark:text-orange-300">GSL</h1>
        </div>
        <nav class="mt-4">
          <template v-if="userRole === 'admin' || userRole === 'manager'">
            <a href="#" class="block py-2 px-4 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">Home</a>
            <a href="#" class="block py-2 px-4 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">User Management</a>
            <a href="#" class="block py-2 px-4 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">Order Tracking</a>
            <a href="#" class="block py-2 px-4 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">Package Management</a>
            <a href="#" class="block py-2 px-4 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">Inventory</a>
            <a href="#" class="block py-2 px-4 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">Delivery Services</a>
          </template>
          <template v-else-if="userRole === 'glider'">
            <a href="#" class="block py-2 px-4 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">Package Creation</a>
            <a href="#" class="block py-2 px-4 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">Inventory Management</a>
            <a href="#" class="block py-2 px-4 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">Delivery Services</a>
          </template>
          <template v-else-if="userRole === 'deliverer'">
            <a href="#" class="block py-2 px-4 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">My Deliveries</a>
          </template>
        </nav>
      </aside>

      <!-- Main Content -->
      <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Header -->
        <header class="bg-white dark:bg-gray-800 shadow-md">
          <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center">
              <input type="text" placeholder="Search..." class="w-64 mr-4 px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600" />
              <button class="p-2 rounded-md bg-gray-200 dark:bg-gray-700">
                <Search class="h-4 w-4 text-gray-600 dark:text-gray-300" />
              </button>
            </div>
            <div class="flex items-center space-x-4">
              <button @click="toggleDarkMode" class="p-2 rounded-md bg-gray-200 dark:bg-gray-700">
                <Sun v-if="darkMode" class="h-4 w-4 text-gray-600 dark:text-gray-300" />
                <Moon v-else class="h-4 w-4 text-gray-600 dark:text-gray-300" />
              </button>
              <button class="p-2 rounded-md bg-gray-200 dark:bg-gray-700">
                <Bell class="h-4 w-4 text-gray-600 dark:text-gray-300" />
              </button>
              <div class="relative">
                <button @click="toggleUserMenu" class="relative h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  <img src="/api/placeholder/32/32" alt="User" class="h-8 w-8 rounded-full" />
                </button>
                <div v-if="isUserMenuOpen" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none">
                  <div class="px-4 py-3">
                    <p class="text-sm font-medium text-gray-900 dark:text-white">John Doe</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">john@example.com</p>
                  </div>
                  <div class="py-1">
                    <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                      <Settings class="mr-3 h-5 w-5 text-gray-400" />
                      Settings
                    </a>
                    <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                      Log out
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </header>

        <!-- Main content area -->
        <main class="flex-grow overflow-x-hidden overflow-y-auto bg-gray-100 dark:bg-gray-900">
          <div class="container mx-auto px-4 py-8">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-4">Dashboard</h2>
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
              <div v-for="(metric, index) in metrics" :key="index" class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                <div class="p-5">
                  <div class="flex items-center">
                    <div class="flex-shrink-0">
                      <component :is="metric.icon" class="h-6 w-6 text-gray-400 dark:text-gray-300" />
                    </div>
                    <div class="ml-5 w-0 flex-1">
                      <dl>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                          {{ metric.title }}
                        </dt>
                        <dd>
                          <div class="text-lg font-medium text-gray-900 dark:text-white">
                            {{ metric.value }}
                          </div>
                        </dd>
                      </dl>
                    </div>
                  </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 px-5 py-3">
                  <div class="text-sm">
                    <a href="#" class="font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">
                      View all
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="mt-8 grid gap-4 md:grid-cols-2 lg:grid-cols-7">
              <div class="col-span-4 bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                  <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Recent Activities</h3>
                  <div class="mt-5 space-y-8">
                    <div v-for="activity in recentActivities" :key="activity.id" class="flex items-center space-x-3">
                      <div class="flex-shrink-0">
                        <div class="h-8 w-8 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                          <component :is="activity.icon" class="h-5 w-5 text-gray-500 dark:text-gray-400" />
                        </div>
                      </div>
                      <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">
                          {{ activity.description }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                          {{ activity.time }}
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-span-3 bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                  <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Quick Actions</h3>
                  <div class="mt-5 grid grid-cols-1 gap-4">
                    <button v-for="action in quickActions" :key="action.title" 
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                      <component :is="action.icon" class="mr-3 h-5 w-5" />
                      {{ action.title }}
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { Package, Truck, DollarSign, Users, LayoutDashboard, Clipboard, Settings, Bell, Moon, Sun, Search } from 'lucide-vue-next'

const isUserMenuOpen = ref(false)
const darkMode = ref(false)
const userRole = ref('admin') // Mock user role, replace with actual auth logic

const toggleUserMenu = () => {
  isUserMenuOpen.value = !isUserMenuOpen.value
}

const toggleDarkMode = () => {
  darkMode.value = !darkMode.value
  // Add logic to apply dark mode to the entire app
}

const metrics = [
  { title: 'Total Inventory', value: '1,234', icon: Package },
  { title: 'Pending Deliveries', value: '23', icon: Truck },
  { title: 'Total Revenue', value: '$45,231.89', icon: DollarSign },
  { title: 'Active Customers', value: '573', icon: Users },
]

const recentActivities = [
  { id: 1, description: 'New order #1234 received', time: '2 hours ago', icon: Package },
  { id: 2, description: 'Inventory updated for Product A', time: '5 hours ago', icon: Clipboard },
  { id: 3, description: 'Delivery #5678 completed', time: '1 day ago', icon: Truck },
]

const quickActions = [
  { title: 'Dashboard', icon: LayoutDashboard },
  { title: 'Manage Inventory', icon: Package },
  { title: 'Schedule Delivery', icon: Truck },
  { title: 'Generate Report', icon: Clipboard },
]
</script>

<style>
@import 'tailwindcss/base';
@import 'tailwindcss/components';
@import 'tailwindcss/utilities';
</style>