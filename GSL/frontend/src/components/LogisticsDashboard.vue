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
          <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-4">Dashboard</h2>
          <p class="text-gray-600 dark:text-gray-300">Welcome to your logistics dashboard. Select an option from the sidebar to get started.</p>
          
          <!-- Example of a summary section for admins and managers -->
          <div v-if="userRole === 'admin' || userRole === 'manager'" class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
              <div class="p-5">
                <div class="flex items-center">
                  <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                    <Package class="h-6 w-6 text-white" />
                  </div>
                  <div class="ml-5 w-0 flex-1">
                    <dl>
                      <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Total Packages</dt>
                      <dd class="text-lg font-medium text-gray-900 dark:text-white">1,234</dd>
                    </dl>
                  </div>
                </div>
              </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
              <div class="p-5">
                <div class="flex items-center">
                  <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                    <TrendingUp class="h-6 w-6 text-white" />
                  </div>
                  <div class="ml-5 w-0 flex-1">
                    <dl>
                      <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Deliveries Today</dt>
                      <dd class="text-lg font-medium text-gray-900 dark:text-white">123</dd>
                    </dl>
                  </div>
                </div>
              </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
              <div class="p-5">
                <div class="flex items-center">
                  <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                    <Users class="h-6 w-6 text-white" />
                  </div>
                  <div class="ml-5 w-0 flex-1">
                    <dl>
                      <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Active Users</dt>
                      <dd class="text-lg font-medium text-gray-900 dark:text-white">56</dd>
                    </dl>
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
import { Bell, Moon, Package, Search, Sun, TrendingUp, User, Users } from 'lucide-vue-next'

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
</script>

<style>
@import 'tailwindcss/base';
@import 'tailwindcss/components';
@import 'tailwindcss/utilities';
</style>