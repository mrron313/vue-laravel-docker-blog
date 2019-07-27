import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        user: {},
    },

    mutations: {
        setAuthUser(state, user) {
            state.user = user;
        }
    },

    getters: {
        isLoggedIn(state) {
            return state.user !== null;
        },
        
        userToken(state) {
            return state.user.identification_token;
        }
    },

    plugins: [createPersistedState()],
});

export default store