import {api} from "boot/api";
import {useStore} from "vuex";
import {computed} from "vue";
import logger from "src/logger";
import useLoading from "src/hooks/common/useLoading";

export default function useWorkerServices() {
  const store = useStore();

  const {loading, startLoading, finishLoading} = useLoading();

  const workerServices = computed(() => store.getters["services/getByWorker"]);

  const fetchServices = async (workerId) => {
    try {
      startLoading();
      const services = await api.services.getByWorkerId(workerId);
      await store.dispatch('services/setWorkerServices', {services});
    } catch (error) {
      logger(error);
    } finally {
      finishLoading();
    }
  };
  
  const createService = async (service) => {
    const newService = await api.services.create(service);
    await store.dispatch('services/addWorkerService', {service: newService});
  };

  const updateService = async (service) => {
    await api.services.update(service);
    await store.dispatch('services/updateWorkerService', {service});
  };

  const removeService = async (serviceId) => {
    await api.services.remove(serviceId);
    await store.dispatch('services/removeWorkerService', {serviceId});
  };

  return {
    loading, workerServices, fetchServices, createService, updateService, removeService,
  };
}
