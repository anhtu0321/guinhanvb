const storeInfo = {
    state: {
        menu: 'gui',
    },
    getters: {

    },
    actions: {
        acMenu(contex, menu) {
            contex.commit('muMenu', menu)
        },
    },
    mutations: {
        muMenu(state, menu) {
            state.menu = menu;
        },
    },
}
export default storeInfo;