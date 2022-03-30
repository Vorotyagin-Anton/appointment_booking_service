import {ref} from "vue";

export default function useLoadingStatus() {
  const loading = ref(false);
  const startLoading = () => loading.value = true;
  const finishLoading = () => loading.value = false;
  
  return {
    loading,
    startLoading,
    finishLoading,
  }
}
