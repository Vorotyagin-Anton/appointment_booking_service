import {boot} from 'quasar/wrappers'
import axios from 'axios'
import authModule from "src/api/auth";
import servicesModule from "src/api/services";
import mastersModule from "src/api/masters";
import categoriesModule from "src/api/categories";

// Be careful when using SSR for cross-request state pollution
// due to creating a Singleton instance here;
// If any client changes this (global) instance, it might be a
// good idea to move this instance creation inside of the
// "export default () => {}" function below (which runs individually
// for each client)

const instance = axios.create({
  headers: {
    'Accept': 'application/json'
  }
});

export default boot(({store}) => {

  instance.interceptors.response.use(
    (response) => {
      const data = JSON.parse(response.data);

      if (data.status === 'error') {
         throw new Error(data.message ?? 'Unspecified server error');
      }

      return response;
    },

    (error) => {
      if (error.status === 401 && store.getters['auth/isAuthorized']) {
        store.dispatch('auth/logout');
        window.localStorage.removeItem('user');
      }

      return new Promise.reject(error);
    });
});

const api = {
  auth: authModule(instance),
  services: servicesModule(instance),
  masters: mastersModule(instance),
  categories: categoriesModule(instance)
};

export {api};
