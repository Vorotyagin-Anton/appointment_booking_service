const state = {
  items: [],
};

const getters = {
  items(state) {
    return state.items;
  },
};

const actions = {
  putItems({commit}, payload) {
    commit('putServicesToState', payload);
  },
};

const mutations = {
  putServicesToState(state, payload) {
    state.items = payload;
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
