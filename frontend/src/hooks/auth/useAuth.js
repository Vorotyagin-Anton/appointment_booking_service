import {api} from "boot/api";
import {computed, ref} from "vue";
import {useStore} from "vuex";
import {useRoute, useRouter} from "vue-router";
import useMessage from "src/hooks/auth/useMessage";
import logger from "src/helpers/logger";

export default function useAuth() {
  const store = useStore();
  const router = useRouter();
  const route = useRoute();

  const {showError} = useMessage();

  const user = computed(() => store.getters['auth/user']);
  const isAuthorized = computed(() => store.getters['auth/isAuthorized']);

  const isRequested = ref(false);

  const register = async (email, password, isMaster) => {
    try {
      isRequested.value = true;

      const response = await api.auth.register(email, password, isMaster);

      await store.dispatch('auth/login', response.user);

      window.localStorage.setItem('user', JSON.stringify(response));

      await router.push({name: 'cabinet'});
    } catch (error) {
      await showError(error.message);
      logger(error);
    } finally {
      isRequested.value = false;
    }
  };

  const login = async (email, password) => {
    try {
      isRequested.value = true;

      const response = await api.auth.login(email, password);

      await store.dispatch('auth/login', response.user);

      window.localStorage.setItem('user', JSON.stringify(response));

      await router.push({name: 'cabinet'});
    } catch (error) {
      await showError(error.message);
      logger(error);
    } finally {
      isRequested.value = false;
    }
  };

  const authorize = async () => {
    try {
      let user = window.localStorage.getItem('user');

      if (!user) {
        const response = await api.auth.authorize();

        user = response.user;

        window.localStorage.setItem('user', user);
      }

      await store.dispatch('auth/login', user);
    } catch (error) {
      logger(error);
    }
  };

  const logout = async () => {
    try {
      await store.dispatch('auth/logout');

      window.localStorage.removeItem('user');

      if (route.matched.some(record => record?.meta?.requiredAuth)) {
        await router.push({name: 'main'});
      }

      await api.auth.logout();
    } catch (error) {
      logger(error)
    }
  };

  return {
    user,
    isRequested,
    isAuthorized,
    register,
    login,
    authorize,
    logout,
  }
}
