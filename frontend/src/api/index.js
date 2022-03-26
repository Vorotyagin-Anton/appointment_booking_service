import servicesModule from './catalog/services';

export default function index(axios) {
  return {
    services: servicesModule(axios),
  }
}
