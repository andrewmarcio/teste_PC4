import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import Classes from "../views/Classes.vue";
import Students from "../views/Students.vue";
import Login from "../views/Auth/Login.vue";

import SchoolForm from "../views/Forms/SchoolForm.vue"
import ClassesForm from "../views/Forms/ClassesForm.vue"
import StudentForm from "../views/Forms/StudentForm.vue"

Vue.use(VueRouter);

const routes = [
  {
    path: "/login",
    name: "Login",
    component: Login,
    meta: {
      requiresAuth: false
    }
  },
  {
    path: "/",
    name: "Home",
    component: Home,
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "/classes",
    name: "Classes",
    component: Classes,
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "/students",
    name: "Students",
    component: Students,
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "/students/create",
    name: "StudentForm",
    component: StudentForm,
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "/school/create",
    name: "SchoolCreate",
    component: SchoolForm,
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "/classes/create",
    name: "ClassCreate",
    component: ClassesForm,
    meta: {
      requiresAuth: true
    }
  }
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

router.beforeEach((to, from, next) => {
  const auth = !!localStorage.getItem("token")
  const isLoginPage = to.matched.some(record => record.name == "Login"); 
  
  if (to.matched.some(record => record.meta.requiresAuth)) {
    auth ? next() : next('/login')
  } else {
    auth && isLoginPage ? next("/") : next() 
  }
});

export default router;
