const state = {
  data: [],
};

const getters = {
  get: (state) => {
    return state.data;
  },

  getById: (state) => (id) => {
    return state.data.find(service => service.id === id);
  },
};

const actions = {
  set: ({commit}, payload) => {
    commit('setServices', payload.services);
  },
};

const mutations = {
  setServices: (state, services) => {
    state.data = services;
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
