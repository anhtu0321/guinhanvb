require('./bootstrap');
import Vue from 'vue';
// window.Vue = require('vue');
import appComponent from './app.vue';
// Vue.component('app-component', require('./app.vue').default);
import router from './router.js';

const app = new Vue({
    el: '#app',
    components: { appComponent },
    router,

});