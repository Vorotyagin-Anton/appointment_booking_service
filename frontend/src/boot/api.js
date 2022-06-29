import axios from 'axios'
import userModule from "src/api/user";
import servicesModule from "src/api/services";
import mastersModule from "src/api/masters";
import categoriesModule from "src/api/categories";
import scheduleModule from "src/api/schedule";

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

const api = {
  user: userModule(instance),
  services: servicesModule(instance),
  masters: mastersModule(instance),
  categories: categoriesModule(instance),
  schedule: scheduleModule(instance),
};

export {api};
