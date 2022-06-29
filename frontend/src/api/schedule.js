export default function (axios) {
  return {
    async getByUserId(userId) {
      const response = await axios.get(`/api/users/workers/${userId}`);

      return response.data.workerFreeTime;
    },

    async updateSchedule(userId, payload) {
      await axios.patch(`/api/users/workers/${userId}/worker-available-time`, payload);

      const response = await axios.get(`/api/users/workers/${userId}`);

      return response.data.workerFreeTime;
    }
  };
}
