import {api} from "boot/api";
import {useStore} from "vuex";
import {computed} from "vue";
import logger from "src/logger";
import useLoading from "src/hooks/common/useLoading";

export default function useServices() {
  const store = useStore();

  const {loading, startLoading, finishLoading} = useLoading();

  const services = computed(() => store.getters["services/getAll"]);

  const fetchServices = async () => {
    try {
      startLoading();
      const services = await api.services.get();
      await store.dispatch('services/setList', {services});
    } catch (error) {
      logger(error);
    } finally {
      finishLoading();
    }
  };

  return {loading, services, fetchServices};
}