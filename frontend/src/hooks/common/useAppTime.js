import {computed, ref} from 'vue';

export default function useAppTime() {
  const createdYear = 2022;
  const currentYear = ref((new Date).getFullYear());

  setInterval(() => {
    currentYear.value = (new Date).getFullYear();
  }, 1000 * 3600);

  return computed(() => createdYear !== currentYear.value
    ? `${createdYear} - ${currentYear.value}`
    : createdYear
  );
}
