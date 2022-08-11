import {api} from "boot/api";
import {useStore} from "vuex";
import {useRoute, useRouter} from "vue-router";
import logger from "src/logger";

export default function useLogout() {
  const store = useStore();
  const router = useRouter();
  const route = useRoute();

  return async () => {
    try {
      await store.dispatch('auth/startRequest');
      await api.user.logout();
    } catch (error) {
      logger(error);
    } finally {
      await store.dispatch('auth/logout');

      const isGuardedRoute = route.matched.some(record => {
        return record.meta.guards?.includes('auth');
      });

      if (isGuardedRoute) {
        await router.push({name: 'main'});
      }

      await store.dispatch('auth/finishRequest');
    }
  };
};
