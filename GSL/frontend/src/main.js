import { createApp } from 'vue'
import { createStore } from 'vuex'
import router from './router';
// import { createRouter, createWebHistory } from 'vue-router'
import App from './App.vue'

// // Import your route components
// import Home from './views/HomePage.vue'
// import Profile from './views/ProfilePage.vue'
// import Settings from './views/Settings.vue'
// import Login from './components/Login.vue'
// import LogisticsDashboard from './components/LogisticsDashboard.vue'

// Create the router instance
// const router = createRouter({
//   history: createWebHistory(),
//   routes: [
//     { path: '/', component: Home },
//     { path: '/profile', component: Profile },
//     { path: '/settings', component: Settings },
//     { path: '/login', component: Login },
//     { path: '/dashboard', component: LogisticsDashboard }
//   ]
// })

// Create the Vuex store
const store = createStore({
  state() {
    return {
      auth: {
        isLoggedIn: false
      }
    }
  },
  mutations: {
    // Add your mutations here
  },
  actions: {
    // Add your actions here
  }
})

// Create and mount the Vue application
const app = createApp(App)
app.use(router)
app.use(store)
app.mount('#app')