import {shallowRef} from "vue";
import OrderMasterCard from "components/Order/Cards/OrderMasterCard";
import OrderServiceCard from "components/Order/Cards/OrderServiceCard";
import OrderTimeCard from "components/Order/Cards/OrderTimeCard";
import OrderConfirmCard from "components/Order/Cards/OrderConfirmCard";

const state = {
  isModalOpen: false,

  steps: [
    {
      component: shallowRef(OrderMasterCard),
      data: {
        name: 1,
        title: 'Select master',
        icon: 'settings',
        done: false,
      },
    },
    {
      component: shallowRef(OrderServiceCard),
      data: {
        name: 2,
        title: 'Select service',
        icon: 'settings',
        done: false,
      },
    },
    {
      component: shallowRef(OrderTimeCard),
      data: {
        name: 3,
        title: 'Select time',
        icon: 'settings',
        done: false,
      },
    },
    {
      component: shallowRef(OrderConfirmCard),
      data: {
        name: 4,
        title: 'Confirm order',
        icon: 'settings',
        done: false,
      },
    },
  ],

  data: {
    master: null,
    service: null, //объект
    date: null,
    time: null, //объект
  },
};

const getters = {
  isModalOpen(state) {
    return state.isModalOpen;
  },

  getData(state) {
    return state.data;
  },

  getSteps(state) {
    return state.steps;
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
  },

  setDate({commit}, payload) {
    commit('setDateToOrder', payload);
  },

  setTime({commit}, payload) {
    commit('setTimeToOrder', payload);
  },

  setStepStatusDone({commit}, payload) {
    commit('setStepStatus', {name: payload, state: true})
  },

  setStepStatusProcess({commit}, payload) {
    commit('setStepStatus', {name: payload, state: false})
  },
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
    console.log('state.data', state.data)
  },

  setDateToOrder(state, payload){
    state.data.date = payload;
  },

  setTimeToOrder(state, payload){
    state.data.time = payload;
    console.log('state.data', state.data)
  },

  setStepStatus(state, payload) {
    const step = state.steps.find(step => step.data.name === payload.name);
    step.data.done = payload.state;
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
};
