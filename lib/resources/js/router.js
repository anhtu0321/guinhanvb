import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter);

// import cac component o duoi:
// -Loai Van ban
import home from './home.vue';
import guinhan from './guinhan.vue';


const routes = [
    // router loai van ban
    { path: '/', component: home },
    { path: '/guinhan', component: guinhan },


]

const router = new VueRouter({
    routes: routes
});

export default router;