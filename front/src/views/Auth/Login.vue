<template>
  <form @submit.prevent="login">
    <b-container class="mt-5">
      <b-row class="justify-content-md-center">
        <b-col cols="4" class="border pt-3">
          <img alt="Vue logo" src="../../assets/user.png" />
          <div class="pt-3">
            <b-form-group id="f-username" label-for="username">
              <b-form-input
                id="username"
                v-model="username"
                trim
                placeholder="Username"
              ></b-form-input>
            </b-form-group>
            <b-form-group id="f-password" label-for="password">
              <b-form-input
                id="password"
                type="password"
                v-model="password"
                trim
                placeholder="Password"
              ></b-form-input>
            </b-form-group>
            <b-form-group id="f-username" label-for="username">
              <b-button block variant="primary" type="submit">Login</b-button>
            </b-form-group>
          </div>
        </b-col>
      </b-row>
    </b-container>
  </form>
</template>

<script>
import { reactive } from "vue";
import api from "../../util/baseApi";

export default {
  name: "Login",
  methods: {
    login() {
      let params = {
        grant_type: "password",
        client_id: process.env.VUE_APP_CLIENT_ID,
        client_secret: process.env.VUE_APP_CLIENT_SECRET,
        username: this.username,
        password: this.password,
      };

      api
        .post("oauth/token", params)
        .then((response) => {
          const { access_token } = response.data;
          localStorage.setItem("token", access_token);
          this.$toast.success("Login efetuado com sucesso!");

          // this.$store.dispatch('setAuth', true);
          this.$router.push("/");
        })
        .catch((error) => {
          console.log(error);
          this.$toast.error("Credenciais inválidas!");
        });
    },
  },
  setup() {
    let data = reactive({
      username: "",
      password: "",
    });

    return {
      data,
    };
  },
};
</script>
