import servicesModule from './catalog/services';
import mastersModule from './catalog/masters';

export default function index(axios) {
  return {
    services: servicesModule(axios),
    masters: mastersModule(axios),
  }
}
