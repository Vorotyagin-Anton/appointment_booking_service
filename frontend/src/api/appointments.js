export default function (axios) {
  return {
    async get(userId) {
      const response = await axios.get(`/api/users/workers/${userId}`);

      return response.data?.worker?.orders ?? [];
    },
  };
}
