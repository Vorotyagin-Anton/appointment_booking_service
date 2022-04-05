const state = {
  pages: 0,
  page: 1,
  perPage: 8,
  items: [],
};

const getters = {
  pages(state) {
    return state.pages;
  },

  page(state) {
    return state.page;
  },

  perPage(state) {
    return state.perPage;
  },

  items(state) {
    const slice = state.items.find((slice) => slice.page === state.page);
    return slice ? slice.data : [];
  },
};

const actions = {
  putItems({commit}, payload) {
    commit('putMastersToState', payload);
  },

  setPage({commit}, payload) {
    commit('setCurrentPage', payload);
  },

  setPages({commit}, payload) {
    commit('setPagesCount', payload);
  },

  setPerPage({commit}, payload) {
    commit('setItemsPerPage', payload);
  },
};

const mutations = {
  putMastersToState(state, payload) {
    state.items.push({
      page: state.page,
      data: payload,
    });
  },

  setCurrentPage(state, payload) {
    state.page = payload;
  },

  setPagesCount(state, payload) {
    state.pages = payload;
  },

  setItemsPerPage(state, payload) {
    state.perPage = payload;
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
