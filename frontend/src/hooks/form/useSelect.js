import {computed, ref} from "vue";

export default function useSelect(items) {
  const selectedItems = ref([]);
  const filteredItems = ref([]);

  const itemsList = computed(() => normalizeItems(items));

  const normalizeItems = (items) => items.value.map(item => {
    return {
      value: item.id,
      label: item.name,
    };
  });

  const filterFn = (val, update) => {
    update(() => {
      if (val === '') {
        filteredItems.value = itemsList.value;
      } else {
        filteredItems.value = itemsList.value.filter(
          v => v.label.toLowerCase().indexOf(val.toLowerCase()) > -1
        )
      }
    });
  };

  return {
    itemsList,
    selectedItems,
    filteredItems,
    filterFn,
  }
}
