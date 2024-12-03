<template>
    <Navbar />
  <h1>Admin</h1>
</template>
<script>
// Import the Navbar component
import Navbar from '@/components/Navbar.vue';  // Adjust the path to match the location of Navbar.vue

export default {
name: 'AdminHome',
components: {
  Navbar,  // Register the Navbar component
},
};
</script>