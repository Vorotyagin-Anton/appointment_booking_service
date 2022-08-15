import {api} from "boot/api";
import {useStore} from "vuex";
import {computed, ref} from "vue";
import logger from "src/logger";
import useLoading from "src/hooks/common/useLoading";

export default function useServices() {
  const store = useStore();

  const page = ref(1);

  const services = computed(() => store.getters['services/getArray']);
  const items = computed(() => store.getters['services/getItems']);
  const pagesCnt = computed(() => store.getters['services/getPagesCnt']);
  const pagesIds = computed(() => store.getters['services/getPagesIds']);

  const itemsIds = computed(() => {
    const getItemsIdsByPage = store.getters['services/getItemsIdsByPage'];
    return getItemsIdsByPage(page.value) ?? [];
  });

  const {loading, startLoading, finishLoading} = useLoading();

  const fetchServices = async (params = {}) => {
    try {
      startLoading();

      const {items, totalPages} = await api.services.get({...params, page: page.value});

      await store.dispatch('services/putItems', {items});
      await store.dispatch('services/putPages', {items, page: page.value})
      await store.dispatch('services/setPagesCnt', {totalPages});
    } catch (error) {
      logger(error);
    } finally {
      finishLoading();
    }
  };

  const flushServices = async () => {
    page.value = 1;
    await store.dispatch('services/flush');
  };

  return {
    loading, page, pagesCnt, services, items, itemsIds, pagesIds, fetchServices, flushServices,
  };
}
