import {onMounted, ref} from "vue";

export default function useFocusObserver(timeout = 0) {
  const elementRef = ref(null);
  const isFocused = ref(false);

  const setFocus = () => isFocused.value = true;
  const unsetFocus = () => isFocused.value = false;

  onMounted(() => {
    let timeoutId;

    elementRef.value.addEventListener('mouseenter', () => {
      timeoutId = setTimeout(setFocus, timeout)
    });

    elementRef.value.addEventListener('mouseleave', () => {
      clearTimeout(timeoutId);
      unsetFocus();
    });
  });

  return {
    elementRef,
    isFocused,
    setFocus,
    unsetFocus,
  }
}
