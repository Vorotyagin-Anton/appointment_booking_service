export default function (axios) {
  return  {
    async get() {
      const response = await axios.get('/api/services');

      return JSON.parse(response.data);
    },
  };
}
