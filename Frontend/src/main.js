import { createApp } from 'vue'
import { createPinia } from 'pinia'
import axios from 'axios'
import App from './App.vue'
import router from './router'

import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faUser } from '@fortawesome/free-solid-svg-icons'
import Vue3Toastify, { toast } from 'vue3-toastify';
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import 'vue3-toastify/dist/index.css';

const app = createApp(App);

// Setup Global Axios
const axiosInstance = axios.create({
    baseURL: import.meta.env.VITE_API_URL,
    headers: { 'Authorization': `Bearer ${localStorage.getItem('token')}` },
})
app.config.globalProperties.axios = { ...axiosInstance }
// Setup FontAwesome Icon
library.add(faUser)
app.component('font-awesome-icon', FontAwesomeIcon)
app.component('QuillEditor', QuillEditor)
// Setup Pinia
const pinia = createPinia()
// Injecting axios instance into pinia
pinia.use(({ store }) => {
  store.$axios = app.config.globalProperties.axios;
  store.$router = router;
});
app.use(pinia)
// Setup Router
app.use(router)
// Setup Toaster 
app.use(
  Vue3Toastify,
  {
    autoClose: 2000,
    position : toast.POSITION.BOTTOM_RIGHT,
  },
);
// Mount APP
app.mount('#app')
