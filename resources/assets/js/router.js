import Vue    from "vue";
import Router from "vue-router";

Vue.use(Router);

export default new Router({
  mode: "history",
  base: baseUri,
  routes: [
    {
      path: "/",
      redirect: "/dashboard",
    },

    {
      path: "/dashboard",
      component: require("./pages/Dashboard"),
    },
  ],
});
