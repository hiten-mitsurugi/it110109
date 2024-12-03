<template>
  <div class="bg-gray-100 min-h-screen flex items-center justify-center py-10">
    <div class="container mx-auto px-6">
      <div class="flex flex-col items-center bg-white shadow-lg rounded-lg p-8 sm:p-12 max-w-lg mx-auto">
        <h3 class="text-3xl font-bold text-gray-900 mb-6">Sign Up</h3>
        <p class="text-gray-600 mb-4">Enter your details to create an account</p>

        <!-- Registration Form -->
        <form @submit.prevent="handleRegister" class="w-full">
          <!-- First Name -->
          <label for="firstName" class="block text-sm font-medium text-gray-700 mb-2">First Name*</label>
          <input id="firstName" v-model="firstName" @blur="touched.firstName = true" type="text"
            placeholder="Enter your first name"
            class="w-full px-4 py-3 mb-4 border border-gray-300 rounded-lg text-gray-900 focus:ring-purple-500 focus:border-purple-500 placeholder-gray-500"
            :class="{ 'border-red-500': !isFirstNameValid && touched.firstName }">
          <p v-if="!isFirstNameValid && touched.firstName" class="text-red-500 text-sm">First name must not contain
            special characters or numbers.</p>

          <!-- Last Name -->
          <label for="lastName" class="block text-sm font-medium text-gray-700 mb-2">Last Name*</label>
          <input id="lastName" v-model="lastName" @blur="touched.lastName = true" type="text"
            placeholder="Enter your last name"
            class="w-full px-4 py-3 mb-4 border border-gray-300 rounded-lg text-gray-900 focus:ring-purple-500 focus:border-purple-500 placeholder-gray-500"
            :class="{ 'border-red-500': !isLastNameValid && touched.lastName }">
          <p v-if="!isLastNameValid && touched.lastName" class="text-red-500 text-sm">Last name must not contain special
            characters or numbers.</p>
          <!-- Gender -->
          <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
          <select id="gender" v-model="gender"
            class="w-full px-4 py-3 mb-4 border border-gray-300 rounded-lg text-gray-900 focus:ring-purple-500 focus:border-purple-500">
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
          </select>

          <!-- Email -->
          <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email*</label>
          <input id="email" v-model="email" @blur="touched.email = true" type="email" placeholder="mail@example.com"
            class="w-full px-4 py-3 mb-4 border border-gray-300 rounded-lg text-gray-900 focus:ring-purple-500 focus:border-purple-500 placeholder-gray-500"
            :class="{ 'border-red-500': !isEmailValid && touched.email }">
          <p v-if="!isEmailValid && touched.email" class="text-red-500 text-sm">Invalid email format.</p>

          <!-- Contact Number -->
          <label for="contactNumber" class="block text-sm font-medium text-gray-700 mb-2">Contact Number*</label>
          <input id="contactNumber" v-model="contactNumber" @blur="touched.contactNumber = true" type="text"
            placeholder="Enter your contact number"
            class="w-full px-4 py-3 mb-4 border border-gray-300 rounded-lg text-gray-900 focus:ring-purple-500 focus:border-purple-500 placeholder-gray-500"
            :class="{ 'border-red-500': !isContactNumberValid && touched.contactNumber }">
          <p v-if="!isContactNumberValid && touched.contactNumber" class="text-red-500 text-sm">Contact number must only
            contain digits.</p>

          <!-- Address -->
          <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address*</label>
          <textarea id="address" v-model="address" @blur="touched.address = true" rows="3"
            placeholder="Enter your address"
            class="w-full px-4 py-3 mb-4 border border-gray-300 rounded-lg text-gray-900 focus:ring-purple-500 focus:border-purple-500 placeholder-gray-500"
            :class="{ 'border-red-500': !address && touched.address }"></textarea>
          <p v-if="!address && touched.address" class="text-red-500 text-sm">Address is required.</p>

          <!-- Password -->
          <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password*</label>
          <input id="password" v-model="password" @blur="touched.password = true" type="password"
            placeholder="Enter your password"
            class="w-full px-4 py-3 mb-4 border border-gray-300 rounded-lg text-gray-900 focus:ring-purple-500 focus:border-purple-500 placeholder-gray-500"
            :class="{ 'border-red-500': !isPasswordValid && touched.password }">
          <p v-if="!isPasswordValid && touched.password" class="text-red-500 text-sm">Password must be at least 8
            characters, contain uppercase, lowercase, a number, and a special character.</p>

          <!-- Confirm Password -->
          <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm
            Password*</label>
          <input id="password_confirmation" v-model="password_confirmation" @blur="touched.password_confirmation = true"
            type="password" placeholder="Confirm your password"
            class="w-full px-4 py-3 mb-4 border border-gray-300 rounded-lg text-gray-900 focus:ring-purple-500 focus:border-purple-500 placeholder-gray-500"
            :class="{ 'border-red-500': !isPasswordsMatch && touched.password_confirmation }">
          <p v-if="!isPasswordsMatch && touched.password_confirmation" class="text-red-500 text-sm">Passwords do not
            match.</p>

          <!-- Submit Button -->
          <button type="submit"
            class="w-full py-3 mb-4 text-sm font-bold text-white bg-black rounded-lg hover:bg-gray-700 focus:ring-4 focus:ring-purple-300">
            Sign Up
          </button>
        </form>

        <p class="text-sm text-gray-700">
          Already have an account?
          <router-link to="/login" class="font-semibold text-red-600 hover:underline">Login</router-link>
        </p>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      firstName: '',
      lastName: '',
      contactNumber: '',
      gender: '',
      address: '',
      userType: 'user',  // Correct assignment of default value
      email: '',
      password: '',
      password_confirmation: '',
      touched: {
        firstName: false,
        lastName: false,
        email: false,
        contactNumber: false,
        address: false,
        password: false,
        password_confirmation: false,
      },
    };
  },

  computed: {
    isEmailValid() {
      const emailRegEx = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      return emailRegEx.test(this.email);
    },
    isPasswordValid() {
      const passwordRegEx = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;
      return passwordRegEx.test(this.password);
    },
    isFirstNameValid() {
      const nameRegEx = /^[A-Za-z]+$/;
      return nameRegEx.test(this.firstName);
    },
    isLastNameValid() {
      const nameRegEx = /^[A-Za-z]+$/;
      return nameRegEx.test(this.lastName);
    },
    isContactNumberValid() {
      const contactRegEx = /^\+?\d{7,15}$/;  // Allow optional "+" followed by 7-15 digits
      return contactRegEx.test(this.contactNumber);
    },
    isPasswordsMatch() {
      return this.password === this.password_confirmation;
    },
  },
  methods: {
    async handleRegister() {
      const userData = {
        firstName: this.firstName,
        lastName: this.lastName,
        contactNumber: this.contactNumber,
        gender: this.gender,
        address: this.address,
        email: this.email,
        password: this.password,
        password_confirmation: this.password_confirmation,
        userType: this.userType, // Make sure userType is included
      };

      try {
        const response = await axios.post('/register', userData);

        if (response.data.message === 'Registration Successful') {
          alert('Registered Successfully');
          this.$router.push('/login');
        }
      } catch (error) {
        console.error('Registration failed:', error.response || error);

        if (error.response) {
          alert(`Registration failed: ${error.response.data.message || 'Unknown error'}`);
        } else {
          alert('Network error, please try again later.');
        }

       
      }
    },
  }

};
</script>

<style scoped>
/* Optional: Add any scoped CSS here */
</style>
