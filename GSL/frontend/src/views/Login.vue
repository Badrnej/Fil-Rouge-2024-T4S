<template>
    <div class="login">
      <h2>Login</h2>
      <form @submit.prevent="handleSubmit">
        <div>
          <label for="email">Email:</label>
          <input type="email" id="email" v-model="email" required>
        </div>
        <div>
          <label for="password">Password:</label>
          <input type="password" id="password" v-model="password" required>
        </div>
        <button type="submit">Login</button>
      </form>
    </div>
  </template>
  
  <script>
  import { ref } from 'vue'
  import { useStore } from 'vuex'
  import { useRouter } from 'vue-router'
  
  export default {
    name: 'UserLogin',
    setup() {
      const store = useStore()
      const router = useRouter()
      const email = ref('')
      const password = ref('')
  
      const handleSubmit = async () => {
        try {
          await store.dispatch('auth/login', {
            email: email.value,
            password: password.value
          })
          router.push('/dashboard')
        } catch (error) {
          console.error('Login failed:', error)
          // Handle login error (show message to user)
        }
      }
  
      return {
        email,
        password,
        handleSubmit
      }
    }
  }
  </script>