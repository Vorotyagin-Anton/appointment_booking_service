const state = {
  items: {},
  itemsIds: [],
  pages: {},
  pagesIds: [],
  pagesCnt: 0,
};

const getters = {
  getItems: (state) => {
    return state.items;
  },

  getItemsIds: (state) => {
    return state.itemsIds;
  },

  getItemsIdsByPage: (state) => (page) => {
    return state.pages[page];
  },

  getPagesIds: (state) => {
    return state.pagesIds;
  },

  getPagesCnt: (state) => {
    return state.pagesCnt;
  },
};

const actions = {
  putItems: ({commit}, payload) => {
    commit('putMastersToState', payload.items);
  },

  putPages: ({commit}, payload) => {
    commit('putMastersPageToState', payload);
  },

  setPagesCnt: ({commit}, payload) => {
    commit('setPagesCount', payload.totalPages);
  },

  flush: ({commit}) => {
    commit('flushState');
  },
};

const mutations = {
  putMastersToState: (state, masters) => {
    state.items = masters.reduce((acc, master) => {
      acc[master.id] = master;
      return acc;
    }, state.items);

    state.itemsIds = Object.keys(state.items);
  },

  putMastersPageToState: (state, payload) => {
    const {items, page} = payload;

    state.pages[page] = items.map(item => item.id);
    state.pagesIds = Object.keys(state.pages);
  },

  setPagesCount: (state, pagesCnt) => {
    state.pagesCnt = pagesCnt;
  },

  flushState: (state) => {
    state.items = {};
    state.itemsIds = [];
    state.pages = {};
    state.pagesIds = [];
    state.pagesCnt = 0;
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
