import {useStore} from "vuex";
import {computed} from "vue";

export default function useBreadcrumbs() {
  const store = useStore();

  const breadcrumbs = computed(() => store.getters['breadcrumbs/data']);

  const getByName = (name) => breadcrumbs.value.find(item => item.name === name);

  return {
    getByName,
  };
}
