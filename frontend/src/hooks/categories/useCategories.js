import {api} from "boot/api";
import {useStore} from "vuex";
import {computed} from "vue";
import useLoading from "src/hooks/common/useLoading";

export default function useCategories() {
  const store = useStore();

  const {loading, startLoading, finishLoading} = useLoading();

  const categories = computed(() => store.getters['categories/items']);

  const getFromApi = async () => {
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

  return {
    loading,
    categories,
    getFromApi,
  }
}
