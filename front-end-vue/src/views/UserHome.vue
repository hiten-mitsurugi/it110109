<template>
      <Navbar />
    <h1>User</h1>
</template>
<script>
// Import the Navbar component
import Navbar from '@/components/Navbar.vue';  // Adjust the path to match the location of Navbar.vue

export default {
  name: 'UserHome',
  components: {
    Navbar,  // Register the Navbar component
  },
};
</script>