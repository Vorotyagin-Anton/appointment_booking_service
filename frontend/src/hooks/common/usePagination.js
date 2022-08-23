import {computed, ref} from "vue";

export default function usePagination(items) {
  const page = ref();
  const perPage = ref();

  const pagination = computed(() => {
    const endIdx = page.value * perPage.value;
    const startIdx = endIdx - perPage.value;

    return items.value.slice(startIdx, endIdx);
  });

  return {
    page, perPage, pagination,
  };
}
