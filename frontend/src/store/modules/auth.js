const state = {
  isAuthorized: false,
  user: null,
};

const getters = {
  user(state) {
    return state.user;
  },

  isAuthorized(state) {
    return state.isAuthorized;
  },
};

const actions = {
  login({commit}, payload) {
    commit('putUserToState', payload);
    commit('setAuthorizedStatus', true);
  },

  logout({commit}) {
    commit('putUserToState', null);
    commit('setAuthorizedStatus', false);
  },
};

const mutations = {
  putUserToState(state, payload) {
    state.user = payload;
  },

  setAuthorizedStatus(state, payload) {
    state.isAuthorized = payload;
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
