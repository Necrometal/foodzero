require('./bootstrap');

// import module
import { createApp } from 'vue'
import { createPinia } from 'pinia'

import { useStoreService } from '@services/storeservice'

import { useRouter } from './router';

// import "bootstrap/dist/css/bootstrap.min.css"
// import "bootstrap"
// import 'bootstrap-icons/font/bootstrap-icons.css'

window.asset = process.env.MIX_APP_URL

const pinia = createPinia()
const app = createApp({})

app.use(pinia)

const { initToken } = useStoreService()

Promise.all([initToken()]).then(() => {
    const router = useRouter()
    app.use(router)

    app.mount('#app')
})

// const  Turbolinks = require("turbolinks");
// if (Turbolinks.supported) {
//     Turbolinks.start();
// }


// document.addEventListener('turbolinks:load', () => {
//     app.mount('#app')
// });