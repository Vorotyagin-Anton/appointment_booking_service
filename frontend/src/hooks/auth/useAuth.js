import {api} from "boot/api";
import {computed, ref} from "vue";
import {useStore} from "vuex";
import {useRouter} from "vue-router";
import useMessage from "src/hooks/auth/useMessage";
import useLog from "src/hooks/common/useLog";

export default function useAuth() {
  const store = useStore();
  const router = useRouter();

  const log = useLog();

  const {showError} = useMessage();

  const user = computed(() => store.getters['auth/user']);
  const isAuthorized = computed(() => store.getters['auth/isAuthorized']);

  const isRequested = ref(false);

  const makeRequest = async (callback) => {
    try {
      isRequested.value = true;
      await callback();
    } catch (error) {
      console.log(error)
      log(error);
      const message = getMessageFromError(error);
      await showError(message);
    } finally {
      isRequested.value = false;
    }
  };

  const register = async (email, password, isMaster) => {
    await makeRequest(async () => {
      const response = await api.auth.register(email, password, isMaster);
      await login(response.user);
    })
  };

  const authorize = async (email, password) => {
    await makeRequest(async () => {
      const response = await api.auth.login(email, password);
      await login(response.user);
    });
  };

  const login = async (user) => {
    await store.dispatch('auth/login', user);
    await router.push({name: 'profile'});
  };

  const logout = async () => {
    await store.dispatch('auth/logout');
  };

  return {
    user,
    isRequested,
    isAuthorized,
    register,
    authorize,
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
