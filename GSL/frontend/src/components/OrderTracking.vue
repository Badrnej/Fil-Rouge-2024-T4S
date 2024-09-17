<template>
    <div :class="{ 'dark': darkMode }">
      <div class="flex h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Sidebar -->
        <aside class="w-64 bg-white dark:bg-gray-800 shadow-md">
          <div class="p-4">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Logistics Dashboard</h1>
          </div>
          <nav class="mt-4">
            <template v-if="userRole === 'admin' || userRole === 'manager'">
              <a href="http://localhost:8080/Home-Dashboard" class="block py-2 px-4 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">Home</a>
              <a href="http://localhost:8080/user-management" class="block py-2 px-4 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">User Management</a>
              <a href="http://localhost:8080/order-tracking" class="block py-2 px-4 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">Order Tracking</a>
              <a href="http://localhost:8080/package-management" class="block py-2 px-4 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">Package Management</a>
              <a href="http://localhost:8080/inventory" class="block py-2 px-4 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">Inventory</a>
              <a href="./DeliveryServices.vue" class="block py-2 px-4 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">Delivery Services</a>
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
          <header class="flex items-center justify-between p-4 bg-white dark:bg-gray-800 shadow-md">
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
                <button @click="toggleUserMenu" class="p-2 rounded-md bg-gray-200 dark:bg-gray-700">
                  <User class="h-4 w-4 text-gray-600 dark:text-gray-300" />
                </button>
                <div v-if="showUserMenu" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1">
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Profile</a>
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Settings</a>
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Log out</a>
                </div>
              </div>
            </div>
          </header>
  
          <!-- Main content area -->
          <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 dark:bg-gray-900 p-6">
            <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
              <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                <div>
                  <h2 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Order Tracking</h2>
                  <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">Track and manage customer orders.</p>
                </div>
                <button @click="createOrder" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  Create Order
                </button>
              </div>
              <div class="border-t border-gray-200 dark:border-gray-700">
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                  <li v-for="order in orders" :key="order.id" class="px-4 py-4 sm:px-6">
                    <div class="flex items-center justify-between">
                      <p class="text-sm font-medium text-indigo-600 dark:text-indigo-400 truncate">Order #{{ order.id }}</p>
                      <div class="ml-2 flex-shrink-0 flex">
                        <p :class="statusClasses[order.status]">
                          {{ order.status }}
                        </p>
                      </div>
                    </div>
                    <div class="mt-2 sm:flex sm:justify-between">
                      <div class="sm:flex">
                        <p class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                          <PackageIcon class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400 dark:text-gray-500" />
                          {{ order.items }} items
                        </p>
                        <p class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400 sm:mt-0 sm:ml-6">
                          <CalendarIcon class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400 dark:text-gray-500" />
                          Ordered on {{ order.date }}
                        </p>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </main>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  import { PackageIcon, CalendarIcon, Bell, Moon, Search, Sun, User } from 'lucide-vue-next'
  
  // Mock function to get user role - replace with actual authentication logic
  const getUserRole = () => 'admin'
  
  const userRole = ref(getUserRole())
  const darkMode = ref(false)
  const showUserMenu = ref(false)
  
  const toggleDarkMode = () => {
    darkMode.value = !darkMode.value
    // Add logic to apply dark mode to the entire app
  }
  
  const toggleUserMenu = () => {
    showUserMenu.value = !showUserMenu.value
  }
  
  const createOrder = () => {
    // Add logic to create a new order
    console.log('Creating a new order')
  }
  
  const orders = ref([
    { id: 1001, status: 'Shipped', items: 3, date: '2023-05-01' },
    { id: 1002, status: 'Processing', items: 1, date: '2023-05-02' },
    { id: 1003, status: 'Delivered', items: 2, date: '2023-04-28' },
  ])
  
  const statusClasses = {
    Shipped: 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800',
    Processing: 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800',
    Delivered: 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800',
  }
  </script>
  
  <style>
  @import 'tailwindcss/base';
  @import 'tailwindcss/components';
  @import 'tailwindcss/utilities';
  </style>