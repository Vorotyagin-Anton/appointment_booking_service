import {api} from "boot/api";
import {useStore} from "vuex";
import {computed, onMounted} from "vue";
import useLoading from "src/hooks/common/useLoading";

export default function useList() {
  const store = useStore();

  const {loading, startLoading, finishLoading} = useLoading();

  const categories = computed(() => store.getters['categories/items']);

  const getCategoriesFromApi = async () => {
    try {
      startLoading();

      const response = await api.categories.get();
      await store.dispatch('categories/putItems', response);
    } catch (error) {
      console.dir(error);
    } finally {
      finishLoading();
    }
  };

  onMounted(async () => {
    if (categories.value.length === 0) {
      await getCategoriesFromApi();
    }
  });

  return {
    loading,
    categories,
    getCategoriesFromApi,
  }
}
