<template>
  <div class="container mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold mb-5">Inventory Management</h1>
    <div class="flex flex-col md:flex-row justify-between items-center mb-4 space-y-4 md:space-y-0">
      <div class="relative w-full md:w-auto">
        <Search class="absolute left-2 top-2.5 h-4 w-4 text-gray-400" />
        <input
          v-model="searchTerm"
          placeholder="Search inventory..."
          class="pl-8 pr-4 py-2 w-full md:w-64 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
      </div>
      <div class="space-x-2">
        <button
          @click="showAddItemModal = true"
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
      </div>
    </div>
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white border border-gray-300">
        <thead>
          <tr>
            <th class="py-2 px-4 border-b text-left">Name</th>
            <th class="py-2 px-4 border-b text-left">Quantity</th>
            <th class="py-2 px-4 border-b text-left">Price</th>
            <th class="py-2 px-4 border-b text-left">Category</th>
            <th class="py-2 px-4 border-b text-left">Package Status</th>
            <th class="py-2 px-4 border-b text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in filteredInventory" :key="item.id" class="hover:bg-gray-100">
            <td class="py-2 px-4 border-b">{{ item.name }}</td>
            <td class="py-2 px-4 border-b">{{ item.quantity }}</td>
            <td class="py-2 px-4 border-b">${{ item.price.toFixed(2) }}</td>
            <td class="py-2 px-4 border-b">{{ item.category }}</td>
            <td class="py-2 px-4 border-b">
              <span :class="getStatusClass(item.packageStatus)">
                {{ item.packageStatus }}
              </span>
            </td>
            <td class="py-2 px-4 border-b">
              <button
                @click="updateItemStatus(item)"
                class="text-blue-500 hover:text-blue-700"
              >
                <RefreshCw class="h-4 w-4" />
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Add Item Modal -->
    <div v-if="showAddItemModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
      <div class="bg-white p-6 rounded-lg w-full max-w-md">
        <h2 class="text-xl font-bold mb-4">Add New Inventory Item</h2>
        <div class="space-y-4">
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input
              id="name"
              v-model="newItem.name"
              type="text"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
            />
          </div>
          <div>
            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
            <input
              id="quantity"
              v-model.number="newItem.quantity"
              type="number"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
            />
          </div>
          <div>
            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
            <input
              id="price"
              v-model.number="newItem.price"
              type="number"
              step="0.01"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
            />
          </div>
          <div>
            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
            <input
              id="category"
              v-model="newItem.category"
              type="text"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
            />
          </div>
        </div>
        <div class="mt-6 flex justify-end space-x-3">
          <button
            @click="showAddItemModal = false"
            class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded"
          >
            Cancel
          </button>
          <button
            @click="addItem"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"
          >
            Add Item
          </button>
        </div>
      </div>
    </div>

    <!-- Manual Inventory Modal -->
    <div v-if="showManualInventoryModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
      <div class="bg-white p-6 rounded-lg w-full max-w-lg">
        <h2 class="text-xl font-bold mb-4">Manual Inventory Check</h2>
        <div class="space-y-4 max-h-96 overflow-y-auto">
          <div v-for="item in inventory" :key="item.id" class="flex items-center justify-between">
            <span>{{ item.name }}</span>
            <div>
              <input
                v-model.number="item.manualCount"
                type="number"
                class="w-20 border border-gray-300 rounded-md shadow-sm py-1 px-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
              />
            </div>
          </div>
        </div>
        <div class="mt-6 flex justify-end space-x-3">
          <button
            @click="cancelManualInventory"
            class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded"
          >
            Cancel
          </button>
          <button
            @click="submitManualInventory"
            class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded"
          >
            Submit
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { Search, Plus, ClipboardCheck, RefreshCw } from 'lucide-vue-next'

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
      return 'text-green-600 bg-green-100 px-2 py-1 rounded-full text-xs font-medium'
    case 'Low Stock':
      return 'text-yellow-600 bg-yellow-100 px-2 py-1 rounded-full text-xs font-medium'
    case 'Out of Stock':
      return 'text-red-600 bg-red-100 px-2 py-1 rounded-full text-xs font-medium'
    default:
      return 'text-gray-600 bg-gray-100 px-2 py-1 rounded-full text-xs font-medium'
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

const cancelManualInventory = () => {
  showManualInventoryModal.value = false
}

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