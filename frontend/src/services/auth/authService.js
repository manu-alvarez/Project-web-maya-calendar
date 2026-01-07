import apiClient from '../api/apiClient';

export const authService = {
  async register(data) {
    const response = await apiClient.post('/register', data);
    return response.data;
  },

  async login(credentials) {
    const response = await apiClient.post('/login', credentials);
    return response.data;
  },

  async logout() {
    const response = await apiClient.post('/logout');
    return response.data;
  },

  async getMe() {
    const response = await apiClient.get('/me');
    return response.data;
  },

  async googleLogin(data) {
    const response = await apiClient.post('/google', data);
    return response.data;
  },

  async forgotPassword(email) {
    const response = await apiClient.post('/forgot-password', { email });
    return response.data;
  },

  async resetPassword(data) {
    const response = await apiClient.post('/reset-password', data);
    return response.data;
  },
};
