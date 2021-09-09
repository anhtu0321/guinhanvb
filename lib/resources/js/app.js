require('./bootstrap');
import Vue from 'vue';
// window.Vue = require('vue');
import appComponent from './app.vue';
// Vue.component('app-component', require('./app.vue').default);

const app = new Vue({
    el: '#app',
    components: { appComponent }
});