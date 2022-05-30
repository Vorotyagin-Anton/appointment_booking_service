export default function (axios) {
  return {
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

      const { data } = JSON.parse(response.data);

      return data
    },

    async authorize() {
      const response = await axios.get('/api/check-auth');

      const { data } = JSON.parse(response.data);

      return data;
    },

    async logout() {
      await axios.get('/api/logout');
    },

    async updateProfile(userId, payload) {
      const response = await axios.patch(`/api/users/${userId}`, payload);

      return JSON.parse(response.data);
    },
  };
}
