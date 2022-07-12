import {api} from "boot/api";
import {useStore} from "vuex";
import {useRouter} from "vue-router";

export default function useRegister() {
  const store = useStore();
  const router = useRouter();

  return async (email, password) => {
    const user = await api.user.register(email, password);

    await store.dispatch('auth/login', user);

    window.localStorage.setItem('user', JSON.stringify(user));

    await router.push({name: 'cabinet'});
  };
}
