export default {
    namespaced: true,
    
    state: {
        loading: false
    },
    mutations: {
        CHANGE_LOADING(state, status) {
            state.loading = status
        }
    },

}