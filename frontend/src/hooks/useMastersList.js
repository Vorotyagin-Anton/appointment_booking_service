import {computed, onMounted} from "vue";
import {useStore} from "vuex";
import {api} from "boot/api";
import useLoadingStatus from "src/hooks/common/useLoadingStatus";

export default function useMastersList() {
  const store = useStore();

  const {loading, startLoading, finishLoading} = useLoadingStatus();

  const masters = computed(() => store.getters['masters/items']);

  const getMastersFromApi = async () => {
    try {
      startLoading();

      const payload = await api.masters.get();
      await store.dispatch('masters/putItems', payload);
    } catch (error) {
      console.error(error);
    } finally {
      finishLoading()
    }
  };

  onMounted(() => {
    if (masters.value.length === 0) {
      getMastersFromApi();
    }
  });

  return {
    loading,
    masters,
    getMastersFromApi,
  }
}
