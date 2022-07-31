import {api} from "boot/api";
import {computed} from "vue";
import {useStore} from "vuex";
import {useRoute, useRouter} from "vue-router";
import logger from "src/logger";

export default function useAuth() {
  const store = useStore();
  const router = useRouter();
  const route = useRoute();

  const user = computed(() => store.getters['auth/user']);
  const isAuthorized = computed(() => store.getters['auth/isAuthorized']);
  const isRequested = computed(() => store.getters['auth/isRequested']);

  const authorize = async () => {
    try {
      await store.dispatch('auth/startRequest');

      let user = window.localStorage.getItem('user');

      if (user) {
        user = JSON.parse(user);
      } else {
        user = await api.user.authorize();
        window.localStorage.setItem('user', JSON.stringify(user));
      }

      await store.dispatch('auth/login', user);

      if (route.matched.some(record => record.meta.guards?.includes('guest'))) {
        await router.push({name: 'cabinet'});
      }
    } catch (error) {
      if (error.response?.status === 401) {
        window.localStorage.removeItem('user');
        await store.dispatch('auth/logout');
        return;
      }

      logger(error);
    } finally {
      await store.dispatch('auth/finishRequest');
    }
  };

  return {
    user,
    isAuthorized,
    isRequested,
    authorize,
  }
}
