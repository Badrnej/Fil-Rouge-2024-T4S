<template>
  <div class="min-h-screen bg-gray-900 flex items-center justify-center p-4">
    <div class="max-w-md w-full space-y-8 bg-gray-800 p-8 rounded-xl shadow-2xl transform transition-all hover:scale-105">
      <div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-white">Sign in to your account</h2>
      </div>
      <form class="mt-8 space-y-6" @submit.prevent="handleSubmit">
        <div class="rounded-md shadow-sm -space-y-px">
          <div>
            <label for="email-address" class="sr-only">Email address</label>
            <input
              id="email-address"
              name="email"
              type="email"
              autocomplete="email"
              required
              v-model="email"
              :class="{ 'border-red-500': errors.email }"
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-700 placeholder-gray-500 text-white rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm bg-gray-700"
              placeholder="Email address"
            />
          </div>
          <div>
            <label for="password" class="sr-only">Password</label>
            <input
              id="password"
              name="password"
              type="password"
              autocomplete="current-password"
              required
              v-model="password"
              :class="{ 'border-red-500': errors.password }"
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-700 placeholder-gray-500 text-white rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm bg-gray-700"
              placeholder="Password"
            />
          </div>
        </div>

        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <input
              id="remember-me"
              name="remember-me"
              type="checkbox"
              v-model="rememberMe"
              class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-700 rounded bg-gray-700"
            />
            <label for="remember-me" class="ml-2 block text-sm text-gray-400">Remember me</label>
          </div>

          <div class="text-sm">
            <a href="#" class="font-medium text-indigo-400 hover:text-indigo-300">Forgot your password?</a>
          </div>
        </div>

        <div>
          <button
            type="submit"
            :disabled="isLoading"
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-300 ease-in-out"
          >
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
              <LockClosedIcon class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" aria-hidden="true" />
            </span>
            {{ isLoading ? 'Signing in...' : 'Sign in' }}
          </button>
        </div>
      </form>
      <p v-if="errorMessage" class="mt-2 text-center text-sm text-red-500">{{ errorMessage }}</p>
    </div>
  </div>
</template>

<script setup name="LoginViewComponent">
import { ref, reactive } from 'vue'
import { LockClosedIcon } from 'lucide-vue-next'

const email = ref('')
const password = ref('')
const rememberMe = ref(false)
const isLoading = ref(false)
const errorMessage = ref('')
const errors = reactive({
  email: false,
  password: false
})

const validateForm = () => {
  errors.email = !email.value
  errors.password = !password.value
  return !errors.email && !errors.password
}

const handleSubmit = async () => {
  if (!validateForm()) return

  isLoading.value = true
  errorMessage.value = ''

  try {
    // Here you would typically make an API call to your Laravel backend
    // For example:
    // const response = await axios.post('/api/login', {
    //   email: email.value,
    //   password: password.value,
    //   remember: rememberMe.value
    // })
    
    // Simulating an API call with a timeout
    await new Promise(resolve => setTimeout(resolve, 1500))

    // Handle successful login
    console.log('Login successful')
    // You might want to store the JWT token in localStorage or a cookie here
    // and redirect the user to the dashboard or home page
  } catch (error) {
    // Handle login error
    errorMessage.value = 'Invalid email or password. Please try again.'
  } finally {
    isLoading.value = false
  }
}
</script>