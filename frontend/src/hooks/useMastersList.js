import {ref, computed, onMounted, watch} from "vue";
import {useStore} from "vuex";
import {api} from "boot/api";
import useLoadingStatus from "src/hooks/common/useLoadingStatus";

export default function useMastersList() {
  const store = useStore();

  const {loading, startLoading, finishLoading} = useLoadingStatus();

  const currentPage = computed(() => store.getters['masters/page']);
  const itemsPerPage = computed(() => store.getters['masters/perPage']);
  const pages = computed(() => store.getters['masters/pages']);
  const items = computed(() => store.getters['masters/items']);

  const page = ref(currentPage.value);
  const perPage = ref(itemsPerPage.value);

  const getMastersFromApi = async (page, perPage) => {
    try {
      startLoading();

      const payload = await api.masters.get(page, perPage);

      await store.dispatch('masters/setPages', payload.totalPages);
      await store.dispatch('masters/putItems', payload.items);
    } catch (error) {
      console.error(error);
    } finally {
      finishLoading()
    }
  };

  onMounted(async () => {
    page.value = currentPage.value;
    perPage.value = itemsPerPage.value;

    await getMastersFromApi(page.value, perPage.value);
  });

  watch(page, async () => {
    await store.dispatch('masters/setPage', page.value);

    if (items.value.length === 0) {
      await getMastersFromApi(page.value, perPage.value);
    }
  });

  return {
    items,
    pages,
    page,
    perPage,
    loading,
  }
}
