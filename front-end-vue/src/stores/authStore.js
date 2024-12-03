// src/stores/authStore.js
import { defineStore } from "pinia";
import axios from "@/lib/axios";
import router from "@/router";

const csrf = () => axios.get("/sanctum/csrf-cookie");

export const useAuthStore = defineStore("auth", {
  state: () => ({
    token: localStorage.getItem("token") || null,
    user: null,
  }),
  actions: {
    setUser(user) {
      this.user = user;
    },
    setToken(token) {
      this.token = token;
      localStorage.setItem("token", token); // Save token to localStorage
    },
    async handleSignIn(form) {
      try {
        // Get CSRF token
        await csrf();
    
        // Send login request
        const res = await axios.post("/api/login", form.value);
    
        // Store the token in localStorage
        localStorage.setItem("authToken", res.data.token);
        console.log("Login response: ", res.data);
    
        // Get the userType from the response
        const userType = res.data.user.userType;
    
        // Redirect based on userType
        if (userType === "admin") {
          router.push({ name: "AdminHome" }); // Correct syntax for navigating to a named route
        } else {
          router.push({ name: "UserHome" }); // Correct syntax for navigating to a named route
        }
      } catch (error) {
        console.error("An error occurred during login:", error);
        // Handle error if needed
      }
    },


    signInWithGoogle() {
      console.log("Redirecting to Google Sign-In...");
    },

    async logout() {
      await axios
        .post("/api/logout")
        .then(() => {
          localStorage.clear(), router.push({ name: "Welcome" });
        })
        .catch((error) => {
          if (error.response.status !== 422) {
            localStorage.clear();
            router.push({ name: "login" });
          }
        });
    },
  },
  persist: true, // Optional: If you want to persist the state across page reloads
});
