import axios from 'axios'

const api = axios.create({
  baseURL: process.env.VUE_APP_API_URL,
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  }
})

api.interceptors.request.use(config => {
  const token = localStorage.getItem('token')
  if (token) {
    config.headers['Authorization'] = `Bearer ${token}`
  }
  return config
})

export default {
  login(credentials) {
    return api.post('/login', credentials)
  },
  logout() {
    return api.post('/logout')
  },
  fetchDashboardData() {
    return api.get('/dashboard')
  },
  // Add other API calls here
}