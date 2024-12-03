import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import axios from './lib/axios'  // Import the custom axios instance from axios.js

import App from './App.vue'
import router from './router'

const app = createApp(App)



app.config.globalProperties.$axios = axios // Use the custom axios globally

app.use(createPinia())
app.use(router)

app.mount('#app')
