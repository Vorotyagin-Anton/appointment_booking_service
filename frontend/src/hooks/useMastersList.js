import {ref, onMounted} from "vue";
import {api} from "boot/api";

export default function useMastersList() {
  const isMastersLoaded = ref(false);
  const mastersList = ref([]);

  const getMastersFromApi = async () => {
    try {
      mastersList.value = await api.masters.get();
    } catch (error) {
      console.error(error);
    } finally {
      isMastersLoaded.value = true;
    }
  };

  onMounted(getMastersFromApi);

  return {
    mastersList,
    isMastersLoaded,
    getMastersFromApi,
  }
}
