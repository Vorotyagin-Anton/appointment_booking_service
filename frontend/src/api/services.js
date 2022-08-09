export default function (axios) {
  return  {
    async get() {
      const response = await axios.get('/api/services');

      return response.data;
    },

    async getByWorkerId(userId) {
      const response = await axios.get(`/api/users/workers/${userId}`);

      return response.data.worker.services ?? [];
    },

    async create(userId, service) {
      const response = await axios.post(`/api/worker-services`, {
        ...service,
        worker: userId,
        service: service.service.id,
      });

      return response.data;
    },

    async update(service) {
      const response = await axios.patch(`api/worker-services/${service.id}`, service);

      return response.data;
    },

    async remove(serviceId) {
      await axios.delete(`/api/worker-services/${serviceId}`);

      return true;
    },
  };
}
