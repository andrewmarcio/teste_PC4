import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import Login from "../views/Auth/Login.vue";
import store from "../store";

Vue.use(VueRouter);

const routes = [
  {
    path: "/login",
    name: "Login",
    component: Login,
    meta: { guest: true }
  },
  {
    path: "/",
    name: "Home",
    component: Home,
    meta: { requiresAuth: true }
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});


router.beforeEach((to, from, next) => {

  const isAuth = store.getters.isAuthenticated
  
  if(to.matched.some(record => record.meta.requiresAuth)) {
    if (isAuth) {
      next()
      return
    }
    next('/login')
  } else {
    if(to.matched.some(record => record.name == "Login"))
    {
      console.log(isAuth);
      if(isAuth){
        next("/")
        return
      }
    }
    next()
  }
})

export default router;
