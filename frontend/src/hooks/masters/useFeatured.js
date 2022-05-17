import {api} from "boot/api";
import useLoading from "src/hooks/masters/useLoading";
import {useStore} from "vuex";
import {computed, onMounted} from "vue";
import logger from "src/helpers/logger";

export default function useFeatured() {
  const {startLoading, stopLoading} = useLoading();

  const store = useStore();

  const items = computed(() => store.getters['masters/featured']);

  const getFromApi = async () => {
    try {
      await startLoading();

      const queryParams = {
        page: 1,
        offset: 6,
        // sort: 'rating',
        // order: 'desc',
      };

      const {items} = await api.masters.get(queryParams);

      await store.dispatch('masters/putFeatured', items)
    } catch (error) {
      logger(error);
    } finally {
      await stopLoading();
    }
  };

  const initOnMountedHandler = () => onMounted(async () => {
    if (items.value.length === 0) {
      await getFromApi();
    }
  });

  return {
    items,
    getFromApi,
    initOnMountedHandler,
  }
}
