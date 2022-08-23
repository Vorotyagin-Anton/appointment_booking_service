const state = {
  data: [
    {
      name: 'masters',
      items: [
        {title: 'main', path: {name: 'main'}},
        {title: 'masters', path: {name: 'masters'}},
      ],
    },

    {
      name: 'services',
      items: [
        {title: 'main', path: {name: 'main'}},
        {title: 'services', path: {name: 'services'}},
      ],
    },
  ],
};

const getters = {
  data(state) {
    return state.data;
  },
};

export default {
  namespaced: true,
  state,
  getters,
}
