import {api} from "boot/api";
import {useStore} from "vuex";
import {computed} from "vue";
import logger from "src/logger";
import useLoading from "src/hooks/common/useLoading";
import {ref} from "vue/dist/vue";

export default function useServices() {
  const store = useStore();

  const page = ref(1);

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

      const {items, totalPages} = await api.masters.get({...params, page: page.value});

      await store.dispatch('services/putItems', {items});
      await store.dispatch('services/putPages', {items, page})
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
    loading, page, pagesCnt, items, itemsIds, pagesIds, fetchServices, flushServices,
  };
}
