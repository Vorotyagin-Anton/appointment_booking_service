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

      const { data } = JSON.parse(response.data);

      return data;
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
    
    async updateProfile(payload) {
      console.log(payload);
      
      const response = await axios.get('/api/check-auth');

      const { data } = JSON.parse(response.data);
      
      return data;
    },
  };
}
