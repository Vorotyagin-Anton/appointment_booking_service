import {api} from "boot/api";
import {useStore} from "vuex";
import {useRouter} from "vue-router";

export default function useLogin() {
  const store = useStore();
  const router = useRouter();

  return async (email, password) => {
    await store.dispatch('auth/startRequest');

    const user = await api.user.login(email, password);

    await store.dispatch('auth/login', user);
    window.localStorage.setItem('user', JSON.stringify(user));

    await router.push({name: 'cabinet'});
  };
};
