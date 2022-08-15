import {api} from "boot/api";
import {useStore} from "vuex";
import {computed, ref} from "vue";
import logger from "src/logger";
import useLoading from "src/hooks/common/useLoading";

export default function useMasters() {
  const store = useStore();

  const page = ref(1);

  const items = computed(() => store.getters['masters/getItems']);
  const pagesCnt = computed(() => store.getters['masters/getPagesCnt']);
  const pagesIds = computed(() => store.getters['masters/getPagesIds']);

  const itemsIds = computed(() => {
    const getItemsIdsByPage = store.getters['masters/getItemsIdsByPage'];
    return getItemsIdsByPage(page.value) ?? [];
  });

  const {loading, startLoading, finishLoading} = useLoading();

  const fetchMasters = async (params) => {
    try {
      startLoading();

      const {items, totalPages} = await api.masters.get({...params, page: page.value});

      await store.dispatch('masters/putItems', {items});
      await store.dispatch('masters/putPages', {items, page: page.value})
      await store.dispatch('masters/setPagesCnt', {totalPages});
    } catch (error) {
      logger(error);
    } finally {
      finishLoading();
    }
  };

  const flushMasters = async () => {
    page.value = 1;
    await store.dispatch('masters/flush');
  };

  return {
    loading, page, pagesCnt, items, itemsIds, pagesIds, fetchMasters, flushMasters,
  };
}
