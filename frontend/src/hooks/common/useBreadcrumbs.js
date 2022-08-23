import {useStore} from "vuex";
import {computed} from "vue";

export default function useBreadcrumbs(route) {
  const store = useStore();

  const breadcrumbs = computed(() => store.getters['breadcrumbs/data']);

  return breadcrumbs.value.find(item => item.name === route);
}
