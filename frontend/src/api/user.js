export default function (axios) {
  return {
    async register(email, password) {
      const formData = new FormData();
      formData.append('email', email);
      formData.append('plainPassword', password);

      const response = await axios.post('/api/register', formData, {
        headers: {'Content-Type': 'multipart/form-data'},
      });

      return response.data;
    },

    async login(email, password) {
      const response = await axios.post('/api/login', {
        username: email,
        password,
      });

      return response.data
    },

    async authorize() {
      const response = await axios.get('/api/check-auth');

      return response.data;
    },

    async logout() {
      await axios.get('/api/logout');
    },

    async updateProfile(userId, payload) {
      const response = await axios.patch(`/api/users/${userId}`, payload);

      return response.data;
    },

    async changeAvatar(userId, userPhoto) {
      const formData = new FormData();
      formData.append('userPhoto', userPhoto);

      await axios.post(`/api/users/${userId}/change-photo`, formData, {
        headers: {'Content-Type': 'multipart/form-data'},
      });
    },

    async changePassword(userId, oldPassword, newPassword) {
      await axios.patch('/api/users/change-password', {
        userId,
        oldPassword,
        newPassword,
      });
    },
  };
}
