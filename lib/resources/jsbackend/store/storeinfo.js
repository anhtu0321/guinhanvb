const storeInfo = {
    state: {
        pageList: 1,
        pageDonVi: 1,
        pageChucNang: 1,
        pagePhanQuyen: 1,
        pageTaiKhoan: 1,
        listPermissionOfUser: '',
    },
    getters: {

    },
    actions: {
        aclistPermissionOfUser(context) {
            axios.get('/guinhanvb/listPermissionOfUser')
                .then(response => {
                    context.commit('mulistPermissionOfUser', response.data);
                })
        },
        acPageList(contex, page) {
            contex.commit('muPageList', page)
        },
        acPageDonVi(contex, page) {
            contex.commit('muPageDonVi', page)
        },
        acpageChucNang(contex, page) {
            contex.commit('mupageChucNang', page)
        },
        acpagePhanQuyen(contex, page) {
            contex.commit('mupagePhanQuyen', page)
        },
        acpageTaiKhoan(contex, page) {
            contex.commit('mupageTaiKhoan', page)
        }

    },
    mutations: {
        muPageList(state, page) {
            state.pageList = page;
        },
        muPageDonVi(state, page) {
            state.pageDonVi = page;
        },
        mupageChucNang(state, page) {
            state.pageChucNang = page;
        },
        mupagePhanQuyen(state, page) {
            state.pagePhanQuyen = page;
        },
        mupageTaiKhoan(state, page) {
            state.pagePhanQuyen = page;
        },
        mulistPermissionOfUser(state, data) {
            state.listPermissionOfUser = data;
        }
    },
}
export default storeInfo;