import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter);

// import cac component o duoi:
// -Loai Van ban
import themLoaiVanBan from './components/loaivanban/add.vue';
import suaLoaiVanBan from './components/loaivanban/edit.vue';
// Đơn vị
import themDonVi from './components/donvi/add.vue';
import suaDonVi from './components/donvi/edit.vue';
// -Chức năng
import themchucnang from './components/chucnang/add.vue';
import suachucnang from './components/chucnang/edit.vue';
// -Phân quyền
import themphanquyen from './components/phanquyen/add.vue';
import suaphanquyen from './components/phanquyen/edit.vue';
// -Tài khoản
import themtaikhoan from './components/taikhoan/add.vue';
import suataikhoan from './components/taikhoan/edit.vue';

const routes = [
    // router loai van ban
    { path: '/loaivanban', component: themLoaiVanBan },
    { path: '/loaivanban/edit/:id', component: suaLoaiVanBan },
    // router don vi
    { path: '/donvi', component: themDonVi },
    { path: '/donvi/edit/:id', component: suaDonVi },
    // router chuc nang
    { path: '/chucnang', component: themchucnang },
    { path: '/chucnang/edit/:id', component: suachucnang },
    // router phân quyền
    { path: '/phanquyen', component: themphanquyen },
    { path: '/phanquyen/edit/:id', component: suaphanquyen },
    // router Tài khoản
    { path: '/taikhoan', component: themtaikhoan },
    { path: '/taikhoan/edit/:id', component: suataikhoan },

]

const router = new VueRouter({
    routes: routes
});

export default router;