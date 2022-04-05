export default function (axios) {
  return  {
    async get(pageNumber, itemsPerPage) {
      const params = {
        pageNumber,
        itemsPerPage,
      };

      const response = await axios.get('/api/workers', {params});
      return JSON.parse(response.data);
    },
  };
}
