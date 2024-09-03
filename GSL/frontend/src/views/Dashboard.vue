<template>
    <div class="dashboard">
      <h1>Dashboard</h1>
      <div class="metrics">
        <MetricCard title="Total Packages" :value="totalPackages" />
        <MetricCard title="Deliveries Today" :value="deliveriesToday" />
        <MetricCard title="Active Users" :value="activeUsers" />
      </div>
      <DeliveryTable :deliveries="deliveries" />
    </div>
  </template>
  
  <script>
  import { ref, onMounted } from 'vue'
  import { useStore } from 'vuex'
  import MetricCard from '@/components/MetricCard.vue'
  import DeliveryTable from '@/components/DeliveryTable.vue'
  
  export default {
    name: 'DashboardView',
    components: {
      MetricCard,
      DeliveryTable
    },
    setup() {
      const store = useStore()
      const totalPackages = ref(0)
      const deliveriesToday = ref(0)
      const activeUsers = ref(0)
      const deliveries = ref([])
  
      onMounted(async () => {
        try {
          const dashboardData = await store.dispatch('dashboard/fetchDashboardData')
          totalPackages.value = dashboardData.totalPackages
          deliveriesToday.value = dashboardData.deliveriesToday
          activeUsers.value = dashboardData.activeUsers
          deliveries.value = dashboardData.deliveries
        } catch (error) {
          console.error('Failed to fetch dashboard data:', error)
          // Handle error (show message to user)
        }
      })
  
      return {
        totalPackages,
        deliveriesToday,
        activeUsers,
        deliveries
      }
    }
  }
  </script>