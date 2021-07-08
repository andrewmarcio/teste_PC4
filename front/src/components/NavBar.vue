<template>
  <div>
    <b-navbar toggleable="lg" type="dark" variant="dark">
      <b-navbar-brand href="#"></b-navbar-brand>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
          <router-link class="nav-link" to="/login" v-if="!auth"
            >Login</router-link
          >
          <b-nav-item class="nav-link" @click="logout" v-if="auth"
            >Logout</b-nav-item
          >
          <!-- <b-nav-item v-if="!auth">Login</b-nav-item>
            <b-nav-item v-if="auth">Logout</b-nav-item> -->
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
  </div>
</template>

<script>
import { mapState } from "vuex";

export default {
  name: "NavBar",
  methods: {
    logout() {
      this.$store.dispatch("setAuth", false);
      localStorage.removeItem("token");
      this.$router.push("/login");
    },
  },
  data() {
    const auth = mapState({ authenticated: (state) => state.authenticated });

    return {
      auth,
    };
  },
};
</script>
