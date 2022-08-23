import {computed, ref} from "vue";

export default function useSelect(items) {
  const selectedItems = ref([]);
  const filteredItems = ref([]);

  const itemsList = computed(() => {
    return items.map(item => ({
        value: item.id,
        label: item.name,
        ...item
    }));
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
