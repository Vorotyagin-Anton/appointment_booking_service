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

      const user = await api.user.authorize();

      await store.dispatch('auth/login', user);

      const isGuardedRoute = route.matched.some(record =>  {
        return record.meta.guards?.includes('guest')
      });

      if (isGuardedRoute) {
        await router.push({name: 'cabinet'});
      }
    } catch (error) {
      await store.dispatch('auth/logout');
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
