import {computed} from "vue";
import {useStore} from "vuex";

export default function useLoading() {
  const store = useStore();
  
  const loading = computed(() => store.getters['masters/loading']);
  const startLoading = async () => await store.dispatch('masters/startLoading');
  const stopLoading = async () => await store.dispatch('masters/stopLoading');
  
  return {
    loading,
    startLoading,
    stopLoading,
  }
}
