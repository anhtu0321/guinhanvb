import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);
import storeInfo from './store/storeinfo';

const store = new Vuex.Store(
    storeInfo
)

export default store;