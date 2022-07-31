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

    async create(service) {
      console.log('create', service);
      return {
        ...service,
        id: (new Date).getTime(),
      };
    },

    async update(service) {
      console.log('update', service);
      return true;
    },

    async remove(serviceId) {
      console.log('delete', serviceId)
      return true;
    },
  };
}
