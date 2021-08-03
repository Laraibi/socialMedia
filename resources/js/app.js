require('./bootstrap');

import {createApp} from 'vue'
import App from './components/App.vue'
import "bootstrap-icons/font/bootstrap-icons.css";
// import bootstrap from 'bootstrap';

// import VueRouter from 'vue-router'
import router from './router'

const app = createApp(App)
app.use(router)
app.mount("#App")
// App.use(VueRouter)
