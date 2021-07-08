<template>
  <div class="home">
    <NavBar />
    <!-- <img alt="Vue logo" src="../assets/logo.png" /> -->
    <Card />
  </div>
</template>

<script>
// @ is an alias to /src
import NavBar from "@/components/NavBar.vue";
import Card from "@/components/Card.vue";

export default {
  name: "Home",
  components: {
    NavBar,
    Card,
  },
};
</script>
