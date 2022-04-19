const state = {
  data: [
    {
      name: 'masters',
      items: [
        {title: 'main', path: 'main'},
        {title: 'masters', path: 'masters'},
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
