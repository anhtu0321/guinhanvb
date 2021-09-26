const storeInfo = {
    state: {
        pageList: 1,
    },
    getters: {

    },
    actions: {
        acPageList(contex, page) {
            contex.commit('muPageList', page)
        }
    },
    mutations: {
        muPageList(state, page) {
            state.pageList = page;
        }
    },
}
export default storeInfo;