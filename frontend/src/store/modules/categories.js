const state = {
  items: [],

  promo: [
    'For people who work magic with hair care.',
    'For people who give haircuts and life advice.',
    'For people who believe we should treat ourselves.',
    'For people who push for one more rep.',
    'For people who specialize in health, healing, and self-care.',
    'For people who do what you can’t learn on the internet.',
    'For people who save homes from DIY disasters.',
    'For people who believe practice makes perfect.',
  ],
};

const getters = {
  items(state) {
    return state.items;
  },
};

const actions = {
  putItems({commit}, payload) {
    commit('putCategoriesToState', payload);
  },
};

const mutations = {
  putCategoriesToState(state, payload) {
    state.items = payload.map((item, key) => ({
      ...item,
      promo: state.promo[key],
    }));
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
