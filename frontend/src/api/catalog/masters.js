export default function (axios) {
  return  {
    async get(page, offset) {
      const params = {
        page,
        offset,
      };

      const response = await axios.get('/api/users/workers', {params});

      return JSON.parse(response.data);
    },
  };
}
