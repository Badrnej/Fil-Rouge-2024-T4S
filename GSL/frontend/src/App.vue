<template>
  <div id="app" class="flex flex-col min-h-screen bg-gray-100">
    <header v-if="isLoggedIn" class="bg-white shadow-md">
      <nav class="container mx-auto px-4 py-4">
        <ul class="flex space-x-4">
          <li><router-link to="/" class="text-gray-700 hover:text-black">Home</router-link></li>
          <li><router-link to="/profile" class="text-gray-700 hover:text-black">Profile</router-link></li>
          <li><router-link to="/settings" class="text-gray-700 hover:text-black">Settings</router-link></li>
          <li><button @click="logout" class="text-gray-700 hover:text-black">Logout</button></li>
        </ul>
      </nav>
    </header>
    <!-- <main class="flex-grow container mx-auto px-4 py-8"> -->
      <main class="flex-grow container mx-auto" :style="{ maxWidth: 'unset !important' }">

      <router-view></router-view>
    </main>
    <footer class="bg-gray-800 text-white py-8">
      <div class="container mx-auto px-4">
        <div class="flex flex-wrap justify-between">
          <div class="w-full md:w-1/3 mb-4 md:mb-0">
            <h3 class="text-lg font-semibold mb-2">About Us</h3>
            <p class="text-sm">We are dedicated to providing the best user experience for our customers.</p>
          </div>
          <div class="w-full md:w-1/3 mb-4 md:mb-0">
            <h3 class="text-lg font-semibold mb-2">Contact</h3>
            <p class="text-sm">Email: support@example.com</p>
            <p class="text-sm">Phone: (123) 456-7890</p>
          </div>
          <div class="w-full md:w-1/3">
            <h3 class="text-lg font-semibold mb-2">Follow Us</h3>
            <div class="flex space-x-4">
              <a href="#" class="text-white hover:text-gray-300">Facebook</a>
              <a href="#" class="text-white hover:text-gray-300">Twitter</a>
              <a href="#" class="text-white hover:text-gray-300">Instagram</a>
            </div>
          </div>
        </div>
        <div class="mt-8 text-center text-sm">
          <p>&copy; 2023 Your Company Name. All rights reserved.</p>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
import { computed } from 'vue'
import { useStore } from 'vuex'
import { useRouter } from 'vue-router'

export default {
  name: 'App',
  setup() {
    const store = useStore()
    const router = useRouter()
    const isLoggedIn = computed(() => store.state.auth.isLoggedIn)

    const logout = () => {
      store.dispatch('auth/logout')
      router.push('/login')
    }

    return {
      isLoggedIn,
      logout
    }
  }
}
</script>

<style>
@import 'tailwindcss/base';
@import 'tailwindcss/components';
@import 'tailwindcss/utilities';

/* Add any additional custom styles here */
</style>