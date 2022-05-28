const state = {
  data: [],
  slots: [],
  oldDates: [],
  newDates: [],
};

const getters = {
  data(state) {
    return state.data;
  },

  slots(state) {
    return state.slots;
  },

  oldDates(state) {
    return state.oldDates;
  },

  newDates(state) {
    const dates = [];

    state.slots.map(item => {
      dates.push(...item.dates);
    });

    return dates;
  },

  getSlotsByDate(state) {
    return (date) => {
      const scheduleDate = state.data.find(item => item.exact_date === date);

      if (scheduleDate) {
        return scheduleDate.slots.map(slot => slot.exact_time_in_minutes);
      }

      return [];
    }
  },
};

const actions = {
  putSchedule({commit}, schedule) {
    commit('putScheduleToStorage', schedule);
  },

  putSlots({commit}, slots) {
    commit('putSelectedSlotsToStorage', slots);
  },
};

const mutations = {
  putScheduleToStorage(state, payload) {
    state.data = payload;
    state.oldDates = payload.map(item => item.exact_date);
  },

  putSelectedSlotsToStorage(state, payload) {
    state.slots.push(payload);
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
}
