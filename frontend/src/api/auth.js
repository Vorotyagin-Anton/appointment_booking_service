export default function (axios) {
  return  {
    async register(email, password, isMaster) {
      const formData = new FormData();

      formData.append('email', email);
      formData.append('plainPassword', password);
      formData.append('isWorker', isMaster);

      const params = {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      };

      const response = await axios.post('/api/register', formData, params);

      return JSON.parse(response.data);
    },

    async login(email, password) {
      const payload = {
        username: email,
        password,
      };

      const response = await axios.post('/api/login', payload);

      return response.data;
    },
  };
}
