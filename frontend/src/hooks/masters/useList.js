import {api} from "boot/api";
import {useStore} from "vuex";
import {computed, ref} from "vue";
import useLog from "src/hooks/common/useLog";
import useLoading from "src/hooks/masters/useLoading";

export default function useList() {
  const store = useStore();

  const page = ref(1);

  const pages = computed(() => store.getters['masters/pages']);

  const items = computed(() => {
    const masters = store.getters['masters/items'];

    const slice = masters.find(slice => slice.page === page.value);

    return slice ? slice.items : [];
  });

  const putItems = async (items, pages) => {
    await store.dispatch('masters/setPages', pages);

    await store.dispatch('masters/putItems', {
      items,
      page: page.value,
    });
  }

  const flushItems = () => store.dispatch('masters/flush');

  const log = useLog();

  const {startLoading, stopLoading} = useLoading();

  const getFromApi = async (params) => {
    try {
      await startLoading();

      const queryParams = {
        page: page.value,
        ...params
      };

      const {items, totalPages} = await api.masters.get(queryParams);

      await putItems(items, totalPages);
    } catch (error) {
      log(error);
    } finally {
      await stopLoading();
    }
  };

  return {
    items,
    pages,
    page,
    putItems,
    flushItems,
    getFromApi,
  }
}
