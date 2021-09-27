const storeInfo = {
    state: {
        pageList: 1,
        pageChucNang: 1,
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
        acpageChucNang(contex, page) {
            contex.commit('mupageChucNang', page)
        }
    },
    mutations: {
        muPageList(state, page) {
            state.pageList = page;
        },
        mupageChucNang(state, page) {
            state.pageChucNang = page;
        },
        mulistPermissionOfUser(state, data) {
            state.listPermissionOfUser = data;
        }
    },
}
export default storeInfo;