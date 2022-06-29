import {api} from "boot/api";
import {computed} from "vue";
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
  const isRequested = computed(() => store.getters['auth/isRequested']);

  const register = async (email, password, isMaster) => {
    try {
      await store.dispatch('auth/startRequest');

      const user = await api.auth.register(email, password, isMaster);
      await store.dispatch('auth/login', user);
      window.localStorage.setItem('user', JSON.stringify(user));

      await router.push({name: 'cabinet'});
    } catch (error) {
      await showError(error.message);
      logger(error);
    } finally {
      await store.dispatch('auth/finishRequest');
    }
  };

  const login = async (email, password) => {
    try {
      await store.dispatch('auth/startRequest');

      const user = await api.auth.login(email, password);
      await store.dispatch('auth/login', user);
      window.localStorage.setItem('user', JSON.stringify(user));

      await router.push({name: 'cabinet'});
    } catch (error) {
      await showError(error.message);
      logger(error);
    } finally {
      await store.dispatch('auth/finishRequest');
    }
  };

  const authorize = async () => {
    try {
      await store.dispatch('auth/startRequest');

      let user = window.localStorage.getItem('user');

      if (user) {
        user = JSON.parse(user);
      } else {
        user = await api.auth.authorize();
        window.localStorage.setItem('user', JSON.stringify(user));
      }

      await store.dispatch('auth/login', user);

      if (route.matched.some(record => record?.meta.guards.includes('guest'))) {
        await router.push({name: 'cabinet'});
      }
    } catch (error) {
      logger(error);
    } finally {
      await store.dispatch('auth/finishRequest');
    }
  };

  const logout = async () => {
    try {
      await store.dispatch('auth/logout');

      window.localStorage.removeItem('user');

      if (route.matched.some(record => record?.meta.guards.includes('auth'))) {
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
