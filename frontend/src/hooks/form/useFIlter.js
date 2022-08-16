import {computed} from "vue";

export default function useFilter(data) {
  const items = computed(() => {
    return data.value.map(item => ({
      value: item.id,
      label: item.name,
      ...item
    }));
  });

  const filterFn = (value) => {
    return items.value.filter(v => {
      return v.label.toLowerCase().indexOf(value.toLowerCase()) > -1;
    });
  };

  return {
    items, filterFn,
  };
};
