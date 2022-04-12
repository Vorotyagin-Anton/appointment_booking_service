import {computed, watch} from "vue";
import {useStore} from "vuex";

export default function () {
  const store = useStore();

  const isVisible = computed(() => store.getters['authAlert/isVisible']);
  const type = computed(() => store.getters['authAlert/getType']);
  const message = computed(() => store.getters['authAlert/getMessage'])
  const lifetime = computed(() => store.getters['authAlert/getLifetime']);

  const showInfo = (message, lifetime = 0) => {
    store.dispatch('authAlert/show', {message, lifetime, type: 'info'});
  };

  const showError = (message, lifetime = 0) => {
    store.dispatch('authAlert/show', {message, lifetime, type: 'error'});
  };

  const showSuccess = (message, lifetime = 0) => {
    store.dispatch('authAlert/show', {message, lifetime, type: 'success'});
  }

  const hide = () => store.dispatch('authAlert/hide');

  const makeClassByType = (prefix) => computed(() => prefix + type.value);

  const callLifetimeWatcher = () => {
    watch(lifetime, () => {
      if (lifetime.value > 0) {
        setTimeout(hide, lifetime.value);
      }
    });
  };

  return {
    isVisible,
    message,
    hide,
    showInfo,
    showError,
    showSuccess,
    makeClassByType,
    callLifetimeWatcher,
  }
}
