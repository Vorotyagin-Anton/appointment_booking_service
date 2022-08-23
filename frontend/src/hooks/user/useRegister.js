import {api} from "boot/api";
import {useStore} from "vuex";
import {useRouter} from "vue-router";

export default function useRegister() {
  const store = useStore();
  const router = useRouter();

  return async (email, password, type) => {
    await api.user.register(email, password, type);
    const user = await api.user.login(email, password);

    await store.dispatch('auth/login', user);

    await router.push({name: 'cabinet'});
  };
}
