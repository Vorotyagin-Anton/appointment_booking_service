import {computed, ref, onMounted} from "vue";

export default function useSearch(searchCallback = null) {
  const isDisabled = ref(null);

  const input = ref(null);
  const isNotEmpty = computed(() => input.value !== null);
  const resetInput = () => input.value = null;

  const isFocused = ref(false);
  const setFocus = (value) => isFocused.value = value;

  const callSearchCallback = () => {
    if (searchCallback === null) {
      return;
    }

    if (input.value === null) {
      return;
    }

    isDisabled.value = true;

    const result = searchCallback(input.value);

    if (result) {
       isDisabled.value = false;
    }
  };

  onMounted(() => document.addEventListener('keydown', ({keyCode}) => {
    if (keyCode === 13) {
      callSearchCallback(input.value);
    }
  }));

  return {
    input,
    isNotEmpty,
    isDisabled,
    resetInput,
    setFocus,
    callSearchCallback,
  }
}
