import './assets/styles/app.scss'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import Cookies from "@/assets/js/cookies";

// Edit HTML 'data-theme' attribute before loading the app
document.documentElement.setAttribute('data-theme', Cookies.get('theme') || 'light')

const app = createApp(App)

app.use(router)

app.mount('#app')