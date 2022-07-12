export default function (axios) {
  return {
    async get() {
      const response = await axios.get('/api/service-categories');

      return response.data;
    },
  };
}
