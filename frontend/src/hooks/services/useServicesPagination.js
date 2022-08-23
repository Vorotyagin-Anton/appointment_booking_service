import {computed, ref} from "vue";
import useServices from "src/hooks/services/useServices";

export default function useServicesPagination() {
  const {services} = useServices();

  const page = ref(1);
  const perPage = ref(12);

  const pages = computed(() => {
    return Math.ceil(services.value.length / perPage.value);
  });

  const pagination = computed(() => {
    const endIdx = page.value * perPage.value;
    const startIdx = endIdx - perPage.value;

    return services.value.slice(startIdx, endIdx);
  });

  return {
    page, pages, perPage, pagination,
  };
}
