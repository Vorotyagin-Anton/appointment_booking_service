const state = {
  services: {},
  servicesIds: [],
  workerServices: {},
  workerServicesIds: [],
};

const getters = {
  getAll(state) {
    return {
      ids: state.servicesIds,
      entities: state.services,
    };
  },

  getByWorker(state) {
    const entities = state.workerServicesIds.reduce((acc, id) => {
      const workerService = state.workerServices[id];

      acc[id] = {
        ...workerService,
        service: state.services[workerService.service],
      };

      return acc;
    }, {});

    return {
      ids: Object.keys(entities),
      entities,
    };
  },
};

const actions = {
  setList({commit}, payload) {
    commit('putServicesToState', payload.services);
  },

  setWorkerServices({commit}, payload) {
    const workerServices = payload.services.map(workerService => ({
      ...workerService,
      service: workerService.service.id,
    }));

    commit('putWorkerServicesToState', workerServices);
  },

  addWorkerService({commit}, payload) {
    const service = {
      ...payload.service,
      service: payload.service.service.id,
    };

    commit('addWorkerServiceToState', service);
  },

  updateWorkerService({commit}, payload) {
    commit('updateWorkerServices', payload.service);
  },

  removeWorkerService({commit}, payload) {
    commit('removeWorkerServiceFromState', payload.serviceId);
  },
};

const mutations = {
  putServicesToState(state, services) {
    const entities = services.reduce((acc, service) => {
      acc[service.id] = service;
      return acc;
    }, {});

    state.services = entities;
    state.servicesIds = Object.keys(entities);
  },

  putWorkerServicesToState(state, services) {
    const entities = services.reduce((acc, workerService) => {
      acc[workerService.id] = workerService;
      return acc;
    }, state.workerServices);

    state.workerServices = entities;
    state.workerServicesIds = Object.keys(entities);
  },

  addWorkerServiceToState(state, service) {
    state.workerServices[service.id] = service;
    state.workerServicesIds.push(service.id);
  },

  updateWorkerServices(state, service) {
    state.workerServices[service.id] = {
      ...service,
      service: service.service.id
    };
  },

  removeWorkerServiceFromState(state, serviceId) {
    const index = state.workerServicesIds.findIndex(id => parseInt(id) === parseInt(serviceId));
    state.workerServicesIds.splice(index, 1);
    delete state.workerServices[serviceId];
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
