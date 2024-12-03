<template>
  <div class="bg-cream text-gray-900 min-h-screen">
    <!-- Navbar -->
    <nav class="flex justify-between items-center p-6">
      <div class="text-xl font-bold">▲ STARTUP</div>
      <div class="flex space-x-6">
        <a href="#how-it-works" class="hover:text-black hover:scale-105 transition-transform duration-300">How it
          works</a>
        <a href="#features" class="hover:text-black hover:scale-105 transition-transform duration-300">Features</a>
        <a href="#pricing" class="hover:text-black hover:scale-105 transition-transform duration-300">Pricing</a>
        <router-link to="/login" class="hover:text-black hover:scale-105 transition-transform duration-300">Login</router-link>
       <router-link to="/register"
          class="bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800 hover:scale-105 transition-transform duration-300">Signup</router-link>
      </div>

    </nav>

    <!-- Hero Section -->
    <section class="flex flex-col lg:flex-row items-center justify-between px-6 lg:px-24 py-20">
      <!-- Left Content -->
      <div class="text-center lg:text-left max-w-lg space-y-6">
        <h1 class="text-4xl font-extrabold">
          A headline for your <br />
          <span class="underline decoration-black">cool website</span>
        </h1>
        <p class="text-gray-700">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum harum
          tempore consectetur voluptates, cumque nobis laboriosam voluptatem.
        </p>
        <div class="flex space-x-4 justify-center lg:justify-start">
          <button class="bg-black text-white px-6 py-2 rounded-md hover:bg-gray-800">Call to action</button>
          <button class="border border-black px-6 py-2 rounded-md hover:bg-gray-100">Secondary action</button>
        </div>
      </div>

      <!-- Image Content -->
      <div class="relative mt-10 lg:mt-0">
        <img src="../assets/pictures/nike-removebg-preview.png" alt="Laptop" class="rounded-md" />
        <!-- Decorative Lines -->
        <div class="absolute top-0 right-0 transform -translate-x-4 translate-y-4">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="black"
            class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
          </svg>
        </div>
      </div>
    </section>

    <!-- Pagination -->
    <div class="flex justify-center space-x-2">
      <div class="w-3 h-3 bg-black rounded-full"></div>
      <div class="w-3 h-3 bg-gray-400 rounded-full"></div>
      <div class="w-3 h-3 bg-gray-400 rounded-full"></div>
    </div>
  </div>
</template>

<script setup>
// Your script here (if needed)
</script>
