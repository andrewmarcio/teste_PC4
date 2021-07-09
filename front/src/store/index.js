import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    authenticated: !!localStorage.getItem("token"),
  },
  mutations: {
    SET_AUTH: (state, auth) => (state.authenticated = auth),
  },
  actions: {
    setAuth({ commit }, auth) {
      commit("SET_AUTH", auth);
    },
  },
  modules: {},
  getters: {
    isAuthenticated: (state) => state.authenticated,
  },
});
