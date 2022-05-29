import {boot} from 'quasar/wrappers'
import axios from 'axios'
import authModule from "src/api/auth";
import servicesModule from "src/api/services";
import mastersModule from "src/api/masters";
import categoriesModule from "src/api/categories";
import scheduleModule from "src/api/schedule";
import logger from "src/helpers/logger";

// Be careful when using SSR for cross-request state pollution
// due to creating a Singleton instance here;
// If any client changes this (global) instance, it might be a
// good idea to move this instance creation inside of the
// "export default () => {}" function below (which runs individually
// for each client)

const ERROR_RESPONSE_STATUS = 'error';
const VALIDATION_ERROR = 'Validation Failed';
const DEFAULT_ERROR = 'Unspecified server error';

const instance = axios.create({
  headers: {
    'Accept': 'application/json',
  }
});

export default boot(({store}) => {
  instance.interceptors.response.use(
    (response) => {
      logger(response);

      const data = JSON.parse(response.data);

      if (data.status === ERROR_RESPONSE_STATUS) {
        throw new Error(data.message ?? DEFAULT_ERROR);
      }

      if (data.title === VALIDATION_ERROR) {
        let message = data.title;

        if (data.children) {
          const errors = Object.values(data.children);

          for (let error of errors) {
            if (error.errors.length > 0) {
              message = error.errors[0].message;
            }
          }
        }

        throw new Error(message);
      }

      return response;
    },

    (error) => {
      logger(error);

      if (error.status === 401 && store.getters['auth/isAuthorized']) {
        window.localStorage.removeItem('user');
        store.dispatch('auth/logout');
      }

      if (error.status >= 400) {
        const data = error.response.data;

        let message = data.detail ?? data.error;

        if (!message) {
          message = DEFAULT_ERROR;
        }

        throw new Error(message);
      }

      return Promise.reject(error);
    });
});

const api = {
  auth: authModule(instance),
  services: servicesModule(instance),
  masters: mastersModule(instance),
  categories: categoriesModule(instance),
  schedule: scheduleModule(instance),
};

export {api};
