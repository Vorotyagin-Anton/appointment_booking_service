import authModule from 'src/api/auth';
import servicesModule from 'src/api/catalog/services';
import mastersModule from 'src/api/catalog/masters';
import categoriesModule from 'src/api/catalog/categories';

export default function index(axios) {
  const instance = axios.create({});

  return {
    auth: authModule(instance),
    services: servicesModule(instance),
    masters: mastersModule(instance),
    categories: categoriesModule(instance)
  }
}
