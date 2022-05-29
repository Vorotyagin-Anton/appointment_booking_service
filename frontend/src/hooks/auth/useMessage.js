import {computed, onMounted, onUnmounted, watch} from "vue";
import {useStore} from "vuex";

export default function () {
  const store = useStore();

  const isVisible = computed(() => store.getters['alert/isVisible']);
  const type = computed(() => store.getters['alert/type']);
  const message = computed(() => store.getters['alert/message'])
  const lifetime = computed(() => store.getters['alert/lifetime']);

  const showInfo = async (message, lifetime = 0) => {
    await store.dispatch('alert/show', {message, lifetime, type: 'info'});
  };

  const showError = async (message, lifetime = 0) => {
    await store.dispatch('alert/show', {message, lifetime, type: 'error'});
  };

  const showSuccess = async (message, lifetime = 0) => {
    await store.dispatch('alert/show', {message, lifetime, type: 'success'});
  }

  const hide = () => store.dispatch('alert/hide');

  const makeClassByType = (prefix) => computed(() => prefix + type.value);

  let timeoutId = null;

  watch(lifetime, () => {
    if (lifetime.value > 0) {
      timeoutId = setTimeout(hide, lifetime.value);
    }
  });

  onUnmounted(() => {
    if (timeoutId) {
       clearTimeout(timeoutId);
    }

    hide();
  });

  return {
    isVisible,
    message,
    hide,
    showInfo,
    showError,
    showSuccess,
    makeClassByType,
  }
}
