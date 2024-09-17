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
            <a href="#" class="block py-2 px-4 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">Inventory</a>
            <a href="http://localhost:8080/delivery-services" class="block py-2 px-4 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">Delivery Services</a>
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
          <div class="container mx-auto">
            <h1 class="text-2xl font-bold mb-5 text-gray-800 dark:text-white">Inventory Management</h1>
            <div class="flex flex-col md:flex-row justify-between items-center mb-4 space-y-4 md:space-y-0">
              <div class="relative w-full md:w-auto">
                <Search class="absolute left-2 top-2.5 h-4 w-4 text-gray-400" />
                <input
                  v-model="searchTerm"
                  placeholder="Search inventory..."
                  class="pl-8 pr-4 py-2 w-full md:w-64 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                />
              </div>
              <div class="space-x-2">
                <button
                  @click="addItem"
                  class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-flex items-center"
                >
                  <Plus class="mr-2 h-4 w-4" />
                  Add Item
                </button>
                <button
                  @click="performManualInventory"
                  class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded inline-flex items-center"
                >
                  <ClipboardCheck class="mr-2 h-4 w-4" />
                  Manual Inventory
                </button>
                
                <!-- Add a button to submit manual inventory -->
                <button
                  v-if="showManualInventoryModal"
                  @click="submitManualInventory"
                  class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-flex items-center mt-4"
                >
                  Submit Manual Inventory
                </button>
              </div>
            </div>
            <div class="overflow-x-auto">
              <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700">
                <thead>
                  <tr>
                    <th class="py-2 px-4 border-b text-left text-gray-800 dark:text-white">Name</th>
                    <th class="py-2 px-4 border-b text-left text-gray-800 dark:text-white">Quantity</th>
                    <th class="py-2 px-4 border-b text-left text-gray-800 dark:text-white">Price</th>
                    <th class="py-2 px-4 border-b text-left text-gray-800 dark:text-white">Category</th>
                    <th class="py-2 px-4 border-b text-left text-gray-800 dark:text-white">Package Status</th>
                    <th class="py-2 px-4 border-b text-left text-gray-800 dark:text-white">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="item in filteredInventory" :key="item.id" class="hover:bg-gray-100 dark:hover:bg-gray-700">
                    <td class="py-2 px-4 border-b dark:border-gray-700 text-gray-800 dark:text-white">{{ item.name }}</td>
                    <td class="py-2 px-4 border-b dark:border-gray-700 text-gray-800 dark:text-white">{{ item.quantity }}</td>
                    <td class="py-2 px-4 border-b dark:border-gray-700 text-gray-800 dark:text-white">${{ item.price.toFixed(2) }}</td>
                    <td class="py-2 px-4 border-b dark:border-gray-700 text-gray-800 dark:text-white">{{ item.category }}</td>
                    <td class="py-2 px-4 border-b dark:border-gray-700">
                      <span :class="getStatusClass(item.packageStatus)">
                        {{ item.packageStatus }}
                      </span>
                    </td>
                    <td class="py-2 px-4 border-b dark:border-gray-700">
                      <button
                        @click="updateItemStatus(item)"
                        class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300"
                      >
                        <RefreshCw class="h-4 w-4" />
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Add Item Modal -->
            <!-- (Keep the existing modal code, just update the styling for dark mode compatibility) -->

            <!-- Manual Inventory Modal -->
            <!-- (Keep the existing modal code, just update the styling for dark mode compatibility) -->
          </div>
        </main>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { Search, Plus, ClipboardCheck, RefreshCw, Sun, Moon, Bell, User } from 'lucide-vue-next'

// Existing inventory management logic
const inventory = ref([
  { id: 1, name: "Widget A", quantity: 50, price: 9.99, category: "Electronics", packageStatus: "In Stock" },
  { id: 2, name: "Gadget B", quantity: 30, price: 19.99, category: "Electronics", packageStatus: "Low Stock" },
  { id: 3, name: "Tool C", quantity: 20, price: 14.99, category: "Hardware", packageStatus: "Out of Stock" },
])

const searchTerm = ref('')
const showAddItemModal = ref(false)
const showManualInventoryModal = ref(false)
const newItem = ref({
  name: '',
  quantity: 0,
  price: 0,
  category: '',
  packageStatus: 'In Stock'
})

// New variables for the integrated layout
const darkMode = ref(false)
const showUserMenu = ref(false)
const userRole = ref('admin') // Mock user role, replace with actual auth logic

const toggleDarkMode = () => {
  darkMode.value = !darkMode.value
}

const toggleUserMenu = () => {
  showUserMenu.value = !showUserMenu.value
}

// Existing computed properties and methods
const filteredInventory = computed(() => {
  return inventory.value.filter(item =>
    item.name.toLowerCase().includes(searchTerm.value.toLowerCase())
  )
})

const addItem = () => {
  inventory.value.push({
    id: inventory.value.length + 1,
    ...newItem.value
  })
  newItem.value = { name: '', quantity: 0, price: 0, category: '', packageStatus: 'In Stock' }
  showAddItemModal.value = false
}

const getStatusClass = (status) => {
  switch (status) {
    case 'In Stock':
      return 'text-green-600 bg-green-100 dark:text-green-400 dark:bg-green-900 px-2 py-1 rounded-full text-xs font-medium'
    case 'Low Stock':
      return 'text-yellow-600 bg-yellow-100 dark:text-yellow-400 dark:bg-yellow-900 px-2 py-1 rounded-full text-xs font-medium'
    case 'Out of Stock':
      return 'text-red-600 bg-red-100 dark:text-red-400 dark:bg-red-900 px-2 py-1 rounded-full text-xs font-medium'
    default:
      return 'text-gray-600 bg-gray-100 dark:text-gray-400 dark:bg-gray-900 px-2 py-1 rounded-full text-xs font-medium'
  }
}

const updateItemStatus = (item) => {
  const statuses = ['In Stock', 'Low Stock', 'Out of Stock']
  const currentIndex = statuses.indexOf(item.packageStatus)
  item.packageStatus = statuses[(currentIndex + 1) % statuses.length]
}

const performManualInventory = () => {
  inventory.value.forEach(item => {
    item.manualCount = item.quantity
  })
  showManualInventoryModal.value = true
}

// Removed the unused cancelManualInventory function

const submitManualInventory = () => {
  inventory.value.forEach(item => {
    item.quantity = item.manualCount
    delete item.manualCount
    if (item.quantity === 0) {
      item.packageStatus = 'Out of Stock'
    } else if (item.quantity < 10) {
      item.packageStatus = 'Low Stock'
    } else {
      item.packageStatus = 'In Stock'
    }
  })
  showManualInventoryModal.value = false
}
</script>

<style>
@import 'tailwindcss/base';
@import 'tailwindcss/components';
@import 'tailwindcss/utilities';
</style>