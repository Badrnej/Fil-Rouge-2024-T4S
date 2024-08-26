<template>
  <div id="app">
    <header v-if="isLoggedIn">
      <!-- Add navigation menu items here -->
    </header>
    <main>
      <router-view></router-view>
    </main>
    <footer>
      <!-- Add footer content here -->
    </footer>
  </div>
</template>

<script>
import { computed } from 'vue'
import { useStore } from 'vuex'

export default {
  name: 'App',
  setup() {
    const store = useStore()
    const isLoggedIn = computed(() => store.state.auth.isLoggedIn)

    return {
      isLoggedIn
    }
  }
}
</script>

<style>
/* Add your global styles here */
</style>