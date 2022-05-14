import {api} from "boot/api";
import {computed, ref} from "vue";
import {useStore} from "vuex";
import {useRoute, useRouter} from "vue-router";
import useMessage from "src/hooks/auth/useMessage";
import useLog from "src/hooks/common/useLog";

export default function useAuth() {
  const store = useStore();
  const router = useRouter();
  const route = useRoute();

  const log = useLog();

  const {showError} = useMessage();

  const user = computed(() => store.getters['auth/user']);
  const isAuthorized = computed(() => store.getters['auth/isAuthorized']);

  const isRequested = ref(false);

  const register = async (email, password, isMaster) => {
    try {
      isRequested.value = true;

      const response = await api.auth.register(email, password, isMaster);

      await store.dispatch('auth/login', response.user);
      await router.push({name: 'cabinet'});
    } catch (error) {
      log(error);

      const message = getMessageFromError(error);
      await showError(message);
    } finally {
      isRequested.value = false;
    }
  };

  const login = async (email, password) => {
    try {
      isRequested.value = true;

      const response = await api.auth.login(email, password);

      await store.dispatch('auth/login', response.user);
      await router.push({name: 'cabinet'});
    } catch (error) {
      log(error);

      const message = getMessageFromError(error);
      await showError(message);
    } finally {
      isRequested.value = false;
    }
  };

  const logout = async () => {
    try {
      await store.dispatch('auth/logout');

      if (route.matched.some(record => record?.meta?.requiredAuth)) {
        await router.push({name: 'main'});
      }

      await api.auth.logout();
    } catch (error) {
      log(error)
    }
  };

  return {
    user,
    isRequested,
    isAuthorized,
    register,
    login,
    logout,
  }
}

function getMessageFromError(error) {
  const data = error.response.data;

  let message = data.detail ?? data.error;

  if (!message) {
    message = 'Something was wrong. Check your credentials and try again.';
  }

  return message;
}
