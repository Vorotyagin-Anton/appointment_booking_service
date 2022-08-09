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

  add: ({commit}, payload) => {
    commit('addService', payload.service);
  },

  put: ({commit}, payload) => {
    commit('putService', payload.service);
  },

  update: ({commit}, payload) => {
    commit('updateService', payload.service);
  },

  delete: ({commit}, payload) => {
    commit('deleteService', payload.id);
  },
};

const mutations = {
  setServices: (state, services) => {
    state.data = services;
  },

  addService: (state, service) => {
    state.data.push(service);
  },

  putService: (state, service) => {
    const idx = state.data.findIndex(item => item.id === service.id);
    state.data[idx] = service;
  },

  updateService: (state, service) => {
    state.data.forEach(item => {
      if (item.id === service.id) {
        return {...item, ...service};
      }
    });
  },

  deleteService: (state, id) => {
    const idx = state.data.findIndex(item => item.id === id);
    state.data.splice(idx, 1);
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
