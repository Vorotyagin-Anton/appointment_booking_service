const state = {
  data: [
    {
      name: 'masters',
      items: [
        {title: 'main', path: {name: 'main'}},
        {title: 'masters', path: {name: 'masters'}},
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
