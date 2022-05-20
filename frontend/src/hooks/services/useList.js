import {api} from "boot/api";
import {useStore} from "vuex";
import {computed, onMounted} from "vue";
import useLoading from "src/hooks/common/useLoading";

export default function useList() {
  const store = useStore();

  const {loading, startLoading, finishLoading} = useLoading();

  const services = computed(() => store.getters['services/items']);

  const getServicesFromApi = async () => {
    try {
      startLoading();

      const payload = await api.services.get();
      await store.dispatch('services/putItems', payload);
    } catch (error) {
      console.error(error);
    } finally {
      finishLoading();
    }
  };

  onMounted(async () => {
    if (services.value.length === 0) {
      await getServicesFromApi();
    }
  });

  return {
    loading,
    services,
    getServicesFromApi,
  }
}
