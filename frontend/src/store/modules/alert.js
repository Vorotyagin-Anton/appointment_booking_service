const state = {
  type: 'info',
  isVisible: false,
  message: '',
  lifetime: 0,
};

const getters = {
  isVisible(state) {
    return state.isVisible;
  },

  type(state) {
    return state.type;
  },

  message(state) {
    return state.message;
  },

  lifetime(state) {
    return state.lifetime;
  },
};

const actions = {
  show({commit}, payload) {
    commit('isVisible', true);
    commit('type', payload.type);
    commit('message', payload.message);
    commit('lifetime', payload.lifetime);
  },

  hide({commit}) {
    commit('isVisible', false);

    setTimeout(() => {
      commit('type', 'info');
      commit('message', '');
      commit('lifetime', 0);
    }, 1000);
  },
};

const mutations = {
  isVisible(state, payload) {
    state.isVisible = payload;
  },

  type(state, payload) {
    state.type = payload;
  },

  message(state, payload) {
    state.message = payload;
  },

  lifetime(state, payload) {
    state.lifetime = payload;
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
