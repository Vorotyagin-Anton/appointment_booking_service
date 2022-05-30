const state = {
  status: {
    NEW: 'new',
    OLD: 'old',
  },

  // slots list
  slots: [
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
  ],

  // schedule from server
  data: [],

  selectedDates: [],

  oldDates: [],
  newDates: [],

  // body parameters for server request
  selectedSlots: {
    add: [],
    delete: [],
  },
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

  selectedDates(state) {
    return state.selectedDates;
  },

  slots(state) {
    if (state.selectedDates.length > 1) {
      return state.slots;
    }

    const date = state.selectedDates[0];

    const scheduleDate = state.data.find(scheduleDate => scheduleDate.exact_date === date);
    const scheduleSlots = scheduleDate ? scheduleDate.slots : [];

    const selectedDate = state.selectedSlots.add.find(selectedDate => selectedDate.date === date);
    const selectedSlots = selectedDate ? selectedDate.slots : [];

    return state.slots.map(slot => {
      for (let scheduleSlot of scheduleSlots) {
        if (scheduleSlot.exact_time_in_minutes !== slot.index) {
          continue;
        }

        let isActive = true;

        if (state.selectedSlots.delete.includes(scheduleSlot.id)) {
          isActive = false;
        }

        return {
          ...slot,
          ...{
            id: scheduleSlot.id,
            status: state.status.OLD,
            isActive,
          },
        }
      }

      for (let selectedSlot of selectedSlots) {
        if (selectedSlot === slot.index) {
          return {
            ...slot,
            ...{
              isActive: true,
              status: state.status.NEW,
            },
          }
        }
      }

      return slot;
    });
  },

  selectedSlots(state) {
    return state.selectedSlots;
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

  setDates({commit}, payload) {
    commit('putSelectedDatesToStorage', payload);
  },

  saveSelect({commit}, payload) {
    commit('putSelectedSlotsToStorage', payload);
  },

  removeSlot({commit}, payload) {
    commit('removeSlotFromStorage', payload);
  },

  resetSelect({commit}) {
    commit('returnToInitialState');
  },
};

const mutations = {
  putScheduleToStorage(state, schedule) {
    state.data = schedule;
    state.oldDates = schedule.map(item => item.exact_date);
  },

  putSelectedDatesToStorage(state, dates) {
    state.selectedDates = dates;
  },

  putSelectedSlotsToStorage(state, slots) {
    const slotsTime = slots.map(slot => slot.index);

    state.selectedDates.forEach(date => {
      state.newDates.push(date);

      const dateSlots = state.selectedSlots.add.find(slot => slot.date === date);

      if (dateSlots) {
        dateSlots.slots = slotsTime;
        return;
      }

      state.selectedSlots.add.push({
        date,
        slots: slotsTime,
      });
    });

    state.selectedDates = [];
  },

  removeSlotFromStorage(state, slots) {
    slots.forEach(slot => {
      if (state.selectedDates.length > 1) {
        return;
      }

      if (slot.id) {
        state.selectedSlots.delete.push(slot.id);
        return;
      }

      const date = state.selectedDates[0];

      state.selectedSlots.add.forEach((dateSlots, key) => {
        if (dateSlots.date === date && dateSlots.slots.includes(slot.index)) {
          if (dateSlots.slots.length === 1) {
            const index = state.newDates.findIndex(date => date === date);

            if (index >= 0) {
              state.newDates.splice(index, 1);
              state.selectedSlots.add.splice(key, 1);
            }
          } else {
            const index = dateSlots.slots.findIndex(dateSlot => dateSlot === slot.index);

            if (index >= 0) {
              dateSlots.slots.splice(index, 1);
            }
          }
        }
      });
    });
  },

  returnToInitialState(state) {
    state.newDates = [];
    state.selectedDates = [];
    state.selectedSlots.add = [];
    state.selectedSlots.delete = [];
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
}
