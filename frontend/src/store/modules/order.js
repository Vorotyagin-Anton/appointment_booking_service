const state = {
  isModalOpen: false,

  data: {
    master: null,
    service: null,
  },
};

const getters = {
  isModalOpen(state) {
    return state.isModalOpen;
  },

  getData(state) {
    return state.data;
  },
};

const actions = {
  setModalStatus({commit}, payload) {
    commit('setOrderModalStatus', payload);
  },

  setMaster({commit}, payload) {
    commit('setMasterToOrder', payload);
  },

  setService({commit}, payload) {
    commit('setServiceToOrder', payload);
  }
};

const mutations = {
  setOrderModalStatus(state, payload) {
    state.isModalOpen = payload;
  },

  setMasterToOrder(state, payload) {
    state.data.master = payload;
  },

  setServiceToOrder(state, payload) {
    state.data.service = payload;
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
};
