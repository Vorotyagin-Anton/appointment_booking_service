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

    if (route.matched.some(record => record?.meta.guards.includes('auth'))) {
      await router.push({name: 'main'});
    }

    await api.user.logout();
  };
};
