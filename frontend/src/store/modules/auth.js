import {hasItem, getItem, setItem, removeItem} from "src/utils/localStorage";

const state = {
  user: getItem('user'),
  isAuthorized: hasItem('user'),
  isRequested: false,
};

const getters = {
  user(state) {
    return state.user;
  },

  isAuthorized(state) {
    return state.isAuthorized;
  },

  isRequested(state) {
    return state.isRequested;
  },
};

const actions = {
  login({commit}, payload) {
    setItem('user', payload);

    commit('putUserToState', payload);
    commit('setAuthorizedStatus', true);
  },

  logout({commit}) {
    removeItem('user');

    commit('putUserToState', null);
    commit('setAuthorizedStatus', false);
  },

  startRequest({commit}) {
    commit('setRequestedStatus', true);
  },

  finishRequest({commit}) {
    commit('setRequestedStatus', false);
  }
};

const mutations = {
  putUserToState(state, payload) {
    state.user = payload;
  },

  setAuthorizedStatus(state, payload) {
    state.isAuthorized = payload;
  },

  setRequestedStatus(state, payload) {
    state.isRequested = payload;
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
