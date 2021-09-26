require('./bootstrap');
import Vue from 'vue';
// window.Vue = require('vue');
import appComponent from './app.vue';
// Vue.component('app-component', require('./app.vue').default);
import router from './router.js';
import store from './store.js';
const app = new Vue({
    el: '#appbackend',
    components: { appComponent },
    router,
    store
});