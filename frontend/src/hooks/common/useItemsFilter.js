import {ref, watch} from "vue";

export function useItemsFilter(initialState = {}) {
  const filters = ref(initialState);

  const applySort = (options) => mergeParams(options);
  const applyFilters = (filters) => mergeParams(filters);

  const mergeParams = (data) => {
    const normalized = {};

    for (let prop in data) {
      if (data[prop] != null && data[prop] !== [] && data[prop] !== '') {
        normalized[prop] = data[prop];
      }
    }

    filters.value = {...filters.value, ...data};
  };

  const onFiltersUpdate = (callback) => watch(filters, callback);

  return {
    filters, applySort, applyFilters, onFiltersUpdate,
  };
}
