<template>
  <div class="bg-gray-100 min-h-screen flex items-center justify-center py-10">
    <div class="container mx-auto px-6">
      <div class="flex flex-col items-center bg-white shadow-lg rounded-lg p-8 sm:p-12 max-w-lg mx-auto">
        <h3 class="text-3xl font-bold text-gray-900 mb-6">Sign In</h3>
        <p class="text-gray-600 mb-4">Enter your email and password</p>

        <button type="button" @click="signInWithGoogle"
          class="flex items-center justify-center w-full py-3 mb-6 text-sm font-medium transition duration-300 rounded-lg text-white bg-black hover:bg-gray-700 focus:ring-4 focus:ring-gray-300">
          <img class="h-5 mr-3"
            src="https://raw.githubusercontent.com/Loopple/loopple-public-assets/main/motion-tailwind/img/logos/logo-google.png"
            alt="Google Logo">
          Sign in with Google
        </button>

        <div class="flex items-center mb-5 w-full">
          <hr class="border-gray-300 flex-grow">
          <p class="mx-4 text-gray-500 text-sm">or</p>
          <hr class="border-gray-300 flex-grow">
        </div>

        <form @submit.prevent="submit" class="w-full">
          <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email*</label>
          <input id="email" v-model="form.email" type="email" placeholder="mail@example.com"
            class="w-full px-4 py-3 mb-4 border border-gray-300 rounded-lg text-gray-900 focus:ring-purple-500 focus:border-purple-500 placeholder-gray-500">

          <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password*</label>
          <input id="password" v-model="form.password" type="password" placeholder="Enter your password"
            class="w-full px-4 py-3 mb-4 border border-gray-300 rounded-lg text-gray-900 focus:ring-purple-500 focus:border-purple-500 placeholder-gray-500">

          <div class="flex items-center justify-between mb-5">
            <label class="flex items-center space-x-2 cursor-pointer">
              <input type="checkbox" v-model="rememberMe" class="form-checkbox text-purple-600">
              <span class="text-sm text-gray-700">Keep me logged in</span>
            </label>
            <a href="javascript:void(0)" class="text-sm text-red-600 hover:underline">Forget password?</a>
          </div>

          <button type="submit"
            class="w-full py-3 mb-4 text-sm font-bold text-white bg-black rounded-lg hover:bg-gray-700 focus:ring-4 focus:ring-purple-300">
            Sign In
          </button>
        </form>

        <p class="text-sm text-gray-700">
          Not registered yet?
          <router-link to="/register" class="font-semibold text-red-600 hover:underline">Create an Account</router-link>
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useAuthStore } from '@/stores/authStore';
import { ref } from 'vue';

import { useRouter } from 'vue-router';

const rememberMe = ref()

const store = useAuthStore()

const form = ref({
 email: '',
  password: ''
})

const submit = async ()=>{
  await store.handleSignIn(form)
}

</script>

<style scoped>
/* Optional: Add any scoped CSS here */
</style>
