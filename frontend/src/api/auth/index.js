export default function (axios) {
  return  {
    async signup(email, password, isMaster) {
      const payload = {
        email,
        password,
        isMaster,
      };

      const response = await axios.post('/api/users', payload);
      return JSON.parse(response.data);
    },
  };
}
