import {api} from "boot/api";
import {useStore} from "vuex";
import {useRoute, useRouter} from "vue-router";

export default function useLogout() {
  const store = useStore();
  const router = useRouter();
  const route = useRoute();

  return async () => {
    await store.dispatch('auth/logout');

    window.localStorage.removeItem('user');

    const isGuardedRoute = route.matched.some(record => {
      return record.meta.guards?.includes('auth');
    });

    if (isGuardedRoute) {
      await router.push({name: 'main'});
    }

    await api.user.logout();
  };
};
