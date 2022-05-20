import {ref} from "vue";
import {api} from "boot/api";
import {useStore} from "vuex";
import logger from "src/helpers/logger";

export default function useProfile() {
  const store = useStore();

  const profile = ref({
    firstName: null,
    lastName: null,
    street: null,
    home: null,
    code: null,
    city: null,
    state: null,
    month: null,
    day: null,
    year: null,
    email: null,
    phone: null,
  });

  const updateProfile = async () => {
    try {
      await store.dispatch('auth/startRequest');

      const payload = parseProfileData(profile.value);

      const {user} = await api.auth.updateProfile(payload);

      window.localStorage.setItem('user', JSON.stringify(user));

      await store.dispatch('auth/login', user);
    } catch (error) {
      logger(error);
    } finally {
      await store.dispatch('auth/finishRequest');
    }
  };

  return {
    profile,
    updateProfile
  }
}

function parseProfileData(profile) {
  const data = {};

  Object
    .entries(profile)
    .forEach(([prop, value]) => {
      if (value === null || value.trim().length === 0) {
        return;
      }

      if (prop === 'month') {
        data.month = value.label;
      }

      return data[prop] = value;
    });

  return data;
}
