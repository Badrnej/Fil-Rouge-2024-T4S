<template>
    <div class="min-h-screen bg-black flex items-center justify-center p-4">
      <div class="w-full max-w-md">
        <h2 class="text-3xl font-bold text-white mb-6 text-center">Create an account</h2>
        <form @submit.prevent="handleSubmit" class="bg-gray-900 shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
          <div class="mb-4">
            <label class="block text-gray-300 text-sm font-bold mb-2" for="username">
              Username
            </label>
            <input
              v-model="form.username"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-300 bg-gray-800 leading-tight focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-transparent"
              id="username"
              type="text"
              placeholder="Enter your username"
              required
            >
          </div>
          <div class="mb-4">
            <label class="block text-gray-300 text-sm font-bold mb-2" for="email">
              Email
            </label>
            <input
              v-model="form.email"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-300 bg-gray-800 leading-tight focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-transparent"
              id="email"
              type="email"
              placeholder="Enter your email"
              required
            >
          </div>
          <div class="mb-4">
            <label class="block text-gray-300 text-sm font-bold mb-2" for="password">
              Password
            </label>
            <input
              v-model="form.password"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-300 bg-gray-800 leading-tight focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-transparent"
              id="password"
              type="password"
              placeholder="Enter your password"
              required
            >
          </div>
          <div class="mb-4">
            <label class="block text-gray-300 text-sm font-bold mb-2" for="password-confirmation">
              Confirm Password
            </label>
            <input
              v-model="form.password_confirmation"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-300 bg-gray-800 leading-tight focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-transparent"
              id="password-confirmation"
              type="password"
              placeholder="Confirm your password"
              required
            >
          </div>
          <div class="mb-4">
            <label class="block text-gray-300 text-sm font-bold mb-2" for="full-name">
              Full Name
            </label>
            <input
              v-model="form.full_name"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-300 bg-gray-800 leading-tight focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-transparent"
              id="full-name"
              type="text"
              placeholder="Enter your full name"
              required
            >
          </div>
          <div class="mb-6">
            <label class="block text-gray-300 text-sm font-bold mb-2" for="role-id">
              Role
            </label>
            <select
              v-model="form.role_id"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-300 bg-gray-800 leading-tight focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-transparent"
              id="role-id"
              required
            >
              <option value="" disabled selected>Select a role</option>
              <option value="1">User</option>
              <option value="2">Admin</option>
              <option value="3">Manager</option>
            </select>
          </div>
          <div v-if="error" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline"> {{ error }}</span>
          </div>
          <div class="flex items-center justify-between">
            <button
              class="bg-white hover:bg-gray-200 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full transition duration-150 ease-in-out"
              type="submit"
            >
              Register
            </button>
          </div>
        </form>
        <p class="text-center text-gray-500 text-xs">
          Already have an account? 
          <a href="/login" class="text-white hover:underline">Log in</a>
        </p>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, reactive } from 'vue'
  
  const form = reactive({
    username: '',
    email: '',
    password: '',
    password_confirmation: '',
    full_name: '',
    role_id: ''
  })
  
  const error = ref('')
  
  const handleSubmit = () => {
    error.value = ''
  
    // Basic form validation
    if (!form.username || !form.email || !form.password || !form.password_confirmation || !form.full_name || !form.role_id) {
      error.value = 'All fields are required'
      return
    }
  
    if (form.password !== form.password_confirmation) {
      error.value = 'Passwords do not match'
      return
    }
  
    // Here you would typically call an API to register the user
    console.log('Registration submitted:', form)
  
    // Reset form after successful submission
    Object.keys(form).forEach(key => form[key] = '')
  }
  </script>