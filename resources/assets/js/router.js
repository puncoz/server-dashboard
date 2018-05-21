import Vue    from "vue";
import Router from "vue-router";

Vue.use(Router);

const router = new Router({
  mode: "history",
  base: baseUri,
  routes: [
    {
      path: "/",
      redirect: "/dashboard",
    },

    {
      path: "/dashboard",
      component: require("./pages/Dashboard/Index"),
      meta: {
        title: "Server Dashboard",
      },
    },

    {
      path: "/database",
      component: require("./pages/Database/Index"),
      meta: {
        title: "Database | Server Dashboard",
      },
    },

    {
      path: "/sql",
      component: require("./pages/Sql/Index"),
      meta: {
        title: "Sql Editor | Server Dashboard",
      },
    },
  ],
});

router.beforeEach((to, from, next) => {
  document.title = to.meta.title;
  next();
});

export default router;
