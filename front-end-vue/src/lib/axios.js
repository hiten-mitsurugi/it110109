// src/axios.js
import Axios from 'axios';

const axios = Axios.create({
    baseURL: 'http://localhost:8000/', 
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Authorization': localStorage.getItem('authToken')
    },
    withCredentials: true,
    withXSRFToken: true
});

// // Interceptor to add the Authorization token to the request headers
// axios.interceptors.request.use(
//     (config) => {
//         // Check if the token is available in localStorage
//         const token = localStorage.getItem('token');  
//         if (token) {
//             // Add the token to the Authorization header for every request
//             config.headers.Authorization = `Bearer ${token}`;
//         }
//         return config;  // Continue with the request
//     },
//     (error) => {
//         // Handle request errors (optional)
//         return Promise.reject(error);
//     }
// );

export default axios;
