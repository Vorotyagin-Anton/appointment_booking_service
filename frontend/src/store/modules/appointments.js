import {formatSlotTime} from "src/utils/format";
import moment from "moment";

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

  getStatusMap: (state) => {
    return Object
      .entries(state.statusMap)
      .map(entry => ({value: entry[0], label: entry[1]}));
  },

  getTodayItems: (state) => {
    return state.ids.reduce((acc, id) => {
      const isToday = moment().diff(state.items[id].time, 'days') <= 1;

      if (isToday) {
        acc.push(state.items[id])
      }

      return acc;
    }, []);
  },

  getCustomers: (state) => {
    const clients = state.ids.reduce((acc, id) => {
      const client = state.items[id].client;
      acc[client.id] = {
        ...client,
        amount: acc[client.id] ? acc[client.id].amount + 1 : 1,
      };

      return acc;
    }, {});

    return Object.values(clients).sort((a, b) => a.amount - b.amount);
  },
};

const actions = {
  put: ({commit}, payload) => {
    commit('putItemsToState', payload.items);
  },

  changeStatus: ({commit}, payload) => {
    commit('changeAppointmentStatus', payload);
  },
};

const mutations = {
  putItemsToState(state, items) {
    state.items = items.reduce((acc, item) => {
      acc[item.id] = {
        ...item,
        clientContactType: state.contactTypeMap[item.clientContactType],
        status: {value: item.status, label: state.statusMap[item.status]},
        time: formatSlotTime(item.time[0].exactDate, item.time[0].exactTimeInMinutes),
      };

      return acc;
    }, state.items);

    state.ids = Object.keys(state.items);
  },

  changeAppointmentStatus: (state, payload) => {
    const {status, appointmentId} = payload;
    state.items[appointmentId].status = status;
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
}
