<template>
  <div class="relative min-h-screen flex items-center justify-center p-4 overflow-hidden">
    <div class="absolute inset-0 z-0">
      <img
        src="/src/assets/gsl.jpeg"
        alt=""
        class="w-full h-full object-cover filter blur-lg"
      />
    </div>
    <div class="relative z-10 max-w-4xl w-full bg-white bg-opacity-90 rounded-lg shadow-xl overflow-hidden">
      <div class="flex flex-col items-center">
        <div class="w-full md:w-48 md:h-48 overflow-hidden">
          <img
            src="#"
            alt="Logistics operations"
            class="w-full h-48 object-cover"
          />
        </div>
        <div class="p-8 text-center">
          <div class="uppercase tracking-wide text-sm text-indigo-600 font-semibold">
            Efficient Stock Management
          </div>
          <h1 class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
            Streamline Your Logistics
          </h1>
          <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-700">
            Our advanced stock manager system revolutionizes your inventory control. 
            Experience real-time updates, predictive analytics, and seamless 
            integration with your existing workflows. Boost efficiency and reduce 
            costs with our cutting-edge solution.
          </p>
          <div class="mt-8">
            <router-link to="/login">
              <button class="bg-indigo-600 hover:bg-orange-400 text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                Login to Stock Manager
              </button>
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'HomePage'
}
</script>

<style scoped>
.filter {
  filter: blur(12px);
}
</style>