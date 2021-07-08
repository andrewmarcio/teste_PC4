import "@babel/polyfill";
import "mutationobserver-shim";
import Vue from "vue";
import "./plugins/fontawesome";
import "./plugins/bootstrap-vue";
import "./plugins/vue-toastification";
import App from "./App.vue";
import router from "./router";
import store from "./store";


Vue.component('pagination', require('laravel-vue-pagination'));

Vue.config.productionTip = false;

new Vue({
  router,
  store,
  render: (h) => h(App),
}).$mount("#app");
