import {ref, onMounted} from "vue";
import {api} from "boot/api";

export default function useServiceList() {
  const isServicesLoaded = ref(false);
  const serviceList = ref([]);

  const getServicesFromApi = async () => {
    try {
      serviceList.value = await api.services.get();
    } catch (error) {
      console.error(error);
    } finally {
      isServicesLoaded.value = true;
    }
  };

  onMounted(getServicesFromApi);

  return {
    serviceList,
    isServicesLoaded,
    getServicesFromApi,
  }
}
