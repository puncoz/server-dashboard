import Vue    from "vue";
import axios  from "axios";
import router from "./router";
import App    from "./App";

window.$ = window.jQuery = require("jquery");
window.Popper = require("popper.js").default;

require("bootstrap");

$("body").tooltip({
  selector: "[data-toggle=tooltip]",
});

Vue.prototype.$http = axios.create();

window.Bus = new Vue({name: "Bus"});

Vue.config.errorHandler = function(err, vm, info) {
  console.log(err);
};

new Vue({
  el: "#root",

  router,

  data() {
    return {
      pageLoading: false,
    };
  },

  render: h => h(App),
});

