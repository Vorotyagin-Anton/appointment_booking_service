import authModule from 'src/api/auth';
import servicesModule from 'src/api/catalog/services';
import mastersModule from 'src/api/catalog/masters';

export default function index(axios) {
  const axiosInstance = axios.create({});

  return {
    auth: authModule(axiosInstance),
    services: servicesModule(axiosInstance),
    masters: mastersModule(axiosInstance),
  }
}
