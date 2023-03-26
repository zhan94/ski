import { createApp } from 'vue/dist/vue.esm-bundler';

import App from './App.vue';
import axios from 'axios';
import router from './router';
import VCalendar from 'v-calendar';
import Modal from "vue-bs-modal";
import SimpleTypeahead from 'vue3-simple-typeahead';
import store from './store'

const app = createApp(App);
app.config.globalProperties.$axios = axios;
app.use(router);
app.use(VCalendar, {})
app.use(Modal);
app.use(SimpleTypeahead);
app.use(store);
app.mount('#app');
