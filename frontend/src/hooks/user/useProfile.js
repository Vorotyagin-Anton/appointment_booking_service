import {ref} from "vue";
import {api} from "boot/api";
import {useStore} from "vuex";
import logger from "src/helpers/logger";
import useLoading from "src/hooks/common/useLoading";
import useMessage from "src/hooks/common/useMessage";
import useAuth from "src/hooks/user/useAuth";

export default function useProfile() {
  const store = useStore();

  const {loading, startLoading, finishLoading} = useLoading();

  const {showError, showSuccess} = useMessage();

  const {user} = useAuth();

  const profile = ref({
    name: user.value.name ?? null,
    surname: user.value.surname ?? null,
    middlename: user.value.middlename ?? null,

    // business
    story: user.value.story ?? null,

    // contacts
    mobilePhoneNumber: user.value.mobilePhoneNumber ?? null,
    website: user.value.website,
    facebook: user.value.facebook,
    instagram: user.value.instagram,
    telegram: user.value.telegram,

    // address
    state: user.value.state ?? null,
    city: user.value.city ?? null,
    code: user.value.code ?? null,
    street: user.value.street ?? null,
    home: user.value.home ?? null,
  });

  const updateProfile = async () => {
    try {
      startLoading();

      const payload = parseProfileData(profile.value);
      const data = await api.user.updateProfile(user.value.id, payload);

      await store.dispatch('auth/login', data);
      window.localStorage.setItem('user', JSON.stringify(data));

      showSuccess('Profile successfully updated.');
    } catch (error) {
      logger(error);
      showError('Something was wrong.');
    } finally {
      finishLoading();
    }
  };

  const changePassword = async (oldPassword, newPassword) => {
    try {
      startLoading();

      await api.user.changePassword(user.value.id, oldPassword, newPassword);

      showSuccess('Password successfully changed.')
    } catch (error) {
      logger(error);
      showError('Something was wrong.');
    } finally {
      finishLoading();
    }
  };

  return {
    loading,
    profile,
    updateProfile,
    changePassword,
  }
}

function parseProfileData(profile) {
  const data = {};

  Object.entries(profile)
    .forEach(([prop, value]) => {
      if (value === null) {
        return;
      }

      return data[prop] = value;
    });

  return data;
}
