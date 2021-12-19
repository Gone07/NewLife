import App from "./App.vue"
import "./bootstrap"
import Vue from "vue"
import router from "./router"
import store from "./store"

window.Vue = Vue;

const app = new Vue({
    router,
    store,
    template: '<App></App>',
    components: {
        App
    }
});

app.$mount('#app');