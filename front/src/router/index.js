import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import Classes from "../views/Classes.vue";
import Students from "../views/Students.vue";
import Login from "../views/Auth/Login.vue";

import SchoolForm from "../views/Forms/SchoolForm.vue"
import ClassesForm from "../views/Forms/ClassesForm.vue"

Vue.use(VueRouter);

const routes = [
  {
    path: "/login",
    name: "Login",
    component: Login,
  },
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/classes",
    name: "Classes",
    component: Classes,
  },
  {
    path: "/students",
    name: "Students",
    component: Students,
  },
  {
    path: "/school/create",
    name: "SchoolCreate",
    component: SchoolForm
  },
  {
    path: "/classes/create",
    name: "ClassCreate",
    component: ClassesForm
  }
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

export default router;
