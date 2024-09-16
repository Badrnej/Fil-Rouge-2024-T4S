<template>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
      <div class="px-4 py-5 sm:px-6">
        <h2 class="text-lg leading-6 font-medium text-gray-900">Delivery Services</h2>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">Manage and track delivery services.</p>
      </div>
      <div class="border-t border-gray-200">
        <ul class="divide-y divide-gray-200">
          <li v-for="service in services" :key="service.id" class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="text-sm font-medium text-indigo-600 truncate">{{ service.name }}</p>
              <div class="ml-2 flex-shrink-0 flex">
                <p :class="service.available ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100'" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                  {{ service.available ? 'Available' : 'Unavailable' }}
                </p>
              </div>
            </div>
            <div class="mt-2 sm:flex sm:justify-between">
              <div class="sm:flex">
                <p class="flex items-center text-sm text-gray-500">
                  <TruckIcon class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" />
                  {{ service.type }}
                </p>
                <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6">
                  <ClockIcon class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" />
                  {{ service.estimatedTime }}
                </p>
              </div>
              <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                <CurrencyDollarIcon class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" />
                {{ service.cost }}
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  import { TruckIcon, ClockIcon, CurrencyDollarIcon } from 'lucide-vue-next'
  
  const services = ref([
    { id: 1, name: 'Express Delivery', type: 'Same-day', estimatedTime: '2-4 hours', cost: '$25.99', available: true },
    { id: 2, name: 'Standard Shipping', type: 'Ground', estimatedTime: '3-5 days', cost: '$9.99', available: true },
    { id: 3, name: 'International Air Freight', type: 'Air', estimatedTime: '5-7 days', cost: '$49.99', available: false },
  ])
  </script>