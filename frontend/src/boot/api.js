import {boot} from "quasar/wrappers";
import axios from 'axios'
import userModule from "src/api/user";
import servicesModule from "src/api/services";
import mastersModule from "src/api/masters";
import categoriesModule from "src/api/categories";
import scheduleModule from "src/api/schedule";
import logModule from "src/api/log";

// Be careful when using SSR for cross-request state pollution
// due to creating a Singleton instance here;
// If any client changes this (global) instance, it might be a
// good idea to move this instance creation inside of the
// "export default () => {}" function below (which runs individually
// for each client)

const instance = axios.create({
  headers: {
    'Accept': 'application/json',
  }
});

function responseInterceptor(response) {
  if (process.env.DEV) {
    console.log("API_RESPONSE:", response.config.url, response);
  }

  return response;
}

function errorInterceptor(error, router, store) {
  if (process.env.DEV) {
    console.log("API_ERROR:", error.config.url, error.response);
  }

  if (error.response.status === 401 || error.response.status === 403) {
    store.dispatch('auth/logout');
    window.localStorage.removeItem('user');

    const isGuardedRoute = router.currentRoute.value.matched.some(record => record.meta.guards?.includes('auth'));

    if (isGuardedRoute) {
      router.push({name: 'main'});
    }
  }

  return Promise.reject(error);
}

export default boot(({router, store}) => {
  instance.interceptors.response.use(
    response => responseInterceptor(response),
    error => errorInterceptor(error, router, store),
  );
});

const api = {
  user: userModule(instance),
  services: servicesModule(instance),
  masters: mastersModule(instance),
  categories: categoriesModule(instance),
  schedule: scheduleModule(instance),
  log: logModule(instance),
};

export {api};
