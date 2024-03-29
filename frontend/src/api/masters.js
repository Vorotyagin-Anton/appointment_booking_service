export default function (axios) {
  return {
    async get(options) {
      const response = await axios.get('/api/users/workers', {params: options});

      return response.data;
    },

    async getById(id) {
      const response = await axios.get(`/api/users/workers/${id}`);

      return {
        ...response.data.worker,
        workerFreeTime: response.data.workerFreeTime,
      };
    },
  };
}
