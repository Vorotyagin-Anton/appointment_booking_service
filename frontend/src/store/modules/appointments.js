const state = {
  ids: [],
  items: {},

  contactTypeMap: {
    1: "phone",
    2: "email",
    3: "telegram",
  },

  statusMap: {
    1: "pending",
    2: "awaiting payment",
    3: "awaiting fulfillment",
    4: "completed",
    5: "shipped",
    6: "cancelled",
    7: "declined",
    8: "refunded",
    9: "disputed",
    10: "partially refunded",
  },
};

const getters = {
  get: (state) => {
    return state.items;
  },

  getIds: (state) => {
    return state.ids;
  },

  getById: (state) => (id) => {
    return state.items[id] ?? null;
  },
};

const actions = {
  put: ({commit}, payload) => {
    commit('putItemsToState', payload.items);
  },
};

const mutations = {
  putItemsToState(state, items) {
    state.items = items.reduce((acc, item) => {
      acc[item.id] = {
        ...item,
        clientContactType: state.contactTypeMap[item.clientContactType],
        status: {value: item.status, label: state.statusMap[item.status]},
      };

      return acc;
    }, state.items);

    state.ids = Object.keys(state.items);
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
}
