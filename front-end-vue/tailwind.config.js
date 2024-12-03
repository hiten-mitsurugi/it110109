/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html", 
    "./src/**/*.{vue,js,ts,jsx,tsx}", // Added .vue for Vue components
  ],
  theme: {
    extend: {}, // Extend this section to customize your theme
  },
  plugins: [], // Add any required plugins here
}
