import {computed, onMounted} from "vue";
import {useStore} from "vuex";
import useLoadingStatus from "src/hooks/common/useLoadingStatus";
import {api} from "boot/api";

export default function useServiceList() {
  const store = useStore();

  const {loading, startLoading, finishLoading} = useLoadingStatus();

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

  onMounted(() => {
    if (services.value.length === 0) {
      getServicesFromApi();
    }
  });

  return {
    loading,
    services,
    getServicesFromApi,
  }
}
