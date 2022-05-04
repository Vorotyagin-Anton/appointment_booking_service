const state = {
  pages: 0,
  items: [],
  loading: false,
};

const getters = {
  pages(state) {
    return state.pages;
  },

  items(state) {
    return state.items;
  },

  loading(state) {
    return state.loading;
  },
};

const actions = {
  putItems({commit}, payload) {
    commit('putMastersToState', payload);
  },

  setPages({commit}, payload) {
    commit('setPagesCount', payload);
  },

  startLoading({commit}) {
    commit('setLoadingValue', true);
  },

  stopLoading({commit}) {
    commit('setLoadingValue', false);
  },

  flush({commit}) {
    commit('flushState');
  },
};

const mutations = {
  putMastersToState(state, payload) {
    state.items.push(payload);
  },

  setPagesCount(state, payload) {
    state.pages = payload;
  },

  setLoadingValue(state, payload) {
    state.loading = payload
  },

  flushState(state) {
    state.items = [];
    state.pages = 0;
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
