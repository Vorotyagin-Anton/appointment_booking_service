const slotsModel = [
  {index: 0, time: '00:00', div: 'am', isActive: false, status: null},
  {index: 60, time: '01:00', div: 'am', isActive: false, status: null},
  {index: 120, time: '02:00', div: 'am', isActive: false, status: null},
  {index: 180, time: '03:00', div: 'am', isActive: false, status: null},
  {index: 240, time: '04:00', div: 'am', isActive: false, status: null},
  {index: 300, time: '05:00', div: 'am', isActive: false, status: null},
  {index: 360, time: '06:00', div: 'am', isActive: false, status: null},
  {index: 420, time: '07:00', div: 'am', isActive: false, status: null},
  {index: 480, time: '08:00', div: 'am', isActive: false, status: null},
  {index: 540, time: '09:00', div: 'am', isActive: false, status: null},
  {index: 600, time: '10:00', div: 'am', isActive: false, status: null},
  {index: 660, time: '11:00', div: 'am', isActive: false, status: null},
  {index: 720, time: '12:00', div: 'am', isActive: false, status: null},
  {index: 780, time: '01:00', div: 'pm', isActive: false, status: null},
  {index: 840, time: '02:00', div: 'pm', isActive: false, status: null},
  {index: 900, time: '03:00', div: 'pm', isActive: false, status: null},
  {index: 960, time: '04:00', div: 'pm', isActive: false, status: null},
  {index: 1020, time: '05:00', div: 'pm', isActive: false, status: null},
  {index: 1080, time: '06:00', div: 'pm', isActive: false, status: null},
  {index: 1140, time: '07:00', div: 'pm', isActive: false, status: null},
  {index: 1200, time: '08:00', div: 'pm', isActive: false, status: null},
  {index: 1260, time: '09:00', div: 'pm', isActive: false, status: null},
  {index: 1320, time: '10:00', div: 'pm', isActive: false, status: null},
  {index: 1380, time: '11:00', div: 'pm', isActive: false, status: null},
];

const state = {
  status: {
    NEW: 'new',
    OLD: 'old',
  },

  // slots list
  slots: slotsModel,

  // schedule from server
  data: [],

  oldDates: [],
  newDates: [],

  // body for server request
  select: [],
};

const getters = {
  status(state) {
    return state.status;
  },

  data(state) {
    return state.data;
  },

  oldDates(state) {
    return state.oldDates;
  },

  newDates(state) {
    return state.newDates;
  },

  select(state) {
    return state.select;
  },

  slots(state) {
    return state.slots;
  },

  getOldSlotsByDate(state) {
    return (date) => {
      const dateSlots = state.data.find(slot => slot.exact_date === date);

      if (dateSlots) {
        return {
          date: date,
          slots: dateSlots.slots.map(slot => ({
            index: slot.exact_time_in_minutes,
            status: state.status.OLD,
          })),
        };
      }

      return null;
    }
  },

  getNewSlotsByDate(state) {
    return (date) => state.slots.find(slot => slot.date === date);
  },
};

const actions = {
  putSchedule({commit}, payload) {
    commit('putScheduleToStorage', payload);
  },

  saveSelect({commit}, payload) {
    commit('putSelectedSlotsToStorage', payload);
  },

  resetSlots({commit}) {
    commit('returnSlotsToInitialState');
  },

  updateSlots({commit}, payload) {
    commit('updateSlotsBySelectedDate', payload);
  },
};

const mutations = {
  putScheduleToStorage(state, schedule) {
    state.data = schedule;
    state.oldDates = schedule.map(item => item.exact_date);
  },

  putSelectedSlotsToStorage(state, slots) {
    slots.dates.forEach(date => {
      state.newDates.push(date);

      const dateSlots = state.select.find(slot => slot.date === date);

      if (dateSlots) {
        dateSlots.slots = slots.slots;
        return;
      }

      state.select.push({date, slots: slots.slots});
    });
  },

  returnSlotsToInitialState(state) {
    state.slots = slotsModel;
  },

  updateSlotsBySelectedDate(state, date) {
    const scheduleDate = state.data.find(scheduleDate => scheduleDate.exact_date === date);
    const scheduleSlots = scheduleDate ? scheduleDate.slots : [];

    const selectedDate = state.select.find(selectedDate => selectedDate.date === date);
    const selectedSlots = selectedDate ? selectedDate.slots : [];

    state.slots = state.slots.map(slot => {
      for (let scheduleSlot of scheduleSlots) {
        if (scheduleSlot.exact_time_in_minutes === slot.index) {
          return {
            ...slot,
            ...{isActive: true, status: state.status.OLD},
          }
        }
      }

      if (selectedSlots.includes(slot.index)) {
        return {
          ...slot,
          ...{isActive: true, status: state.status.NEW},
        }
      }

      return slot;
    });
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
}
