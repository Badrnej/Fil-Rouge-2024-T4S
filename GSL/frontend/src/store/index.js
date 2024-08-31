import { createStore } from 'vuex'
import auth from './modules/auth'
import dashboard from './modules/dashboard'
// Import other modules as needed

export default createStore({
  modules: {
    auth,
    dashboard,
    // Add other modules here
  }
})

// Remove the re-declaration of the dashboard module