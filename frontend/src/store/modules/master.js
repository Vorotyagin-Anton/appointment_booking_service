const state = {
  id: null,
  master: null,
};

const getters = {
  id(state) {
    return state.id;
  },

  data(state) {
    return state.master;
  },
};

const actions = {
  setId({commit}, payload) {
    commit('putIdToState', payload);
  },

  setMaster({commit}, payload) {
    commit('putMasterToState', payload);
  },
};

const mutations = {
  putIdToState(state, payload) {
    state.id = payload;
  },

  putMasterToState(state, payload) {
    state.master = payload;
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
