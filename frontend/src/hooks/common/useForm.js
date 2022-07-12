import {computed, ref} from "vue";
import {useStore} from "vuex";

export default function useForm() {
  const store = useStore();

  const isRequested = computed(() => store.getters['auth/isRequested']);

  const error = ref({
    message: null,
    fields: [],
  });

  const submit = async (callback, ...params) => {
    try {
      await store.dispatch('auth/startRequest');

      await callback(...params);
    } catch (e) {
      let data = e.response.data;

      error.value.message = data.error || data.title || 'Unspecified server error';

      if (data.children) {
        for (let [filed, value] of Object.entries(data.children)) {
          if (value.errors.length > 0) {
            error.value.fields[filed] = value.errors[0].message;
          }
        }
      }
    } finally {
      await store.dispatch('auth/finishRequest');
    }
  };

  const reset = async () => {
    error.value = {
      message: null,
      fields: [],
    };
  };

  return {
    isRequested,
    error,
    submit,
    reset,
  };
}
