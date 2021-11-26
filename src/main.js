import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import vuex from "vuex";

import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";

// import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

// Font Awesome Icons
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'
library.add(fas)

createApp(App)
    .use(store)
    .use(router)
    .use(VueAxios, axios)
    .use(vuex)
    .use(VueSweetalert2)
    .component('fa', FontAwesomeIcon)
    .mount("#app");
