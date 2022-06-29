import {ref} from "vue";
import {api} from "boot/api";
import {useStore} from "vuex";
import logger from "src/helpers/logger";
import useLoading from "src/hooks/common/useLoading";
import useMessage from "src/hooks/user/useMessage";
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

    // birth
    month: user.value.month ? getMonthById(user.value.month) : null,
    day: user.value.day ?? null,
    year: user.value.year ?? null,
  });

  const updateProfile = async () => {
    try {
      startLoading();

      const payload = parseProfileData(profile.value);

      const data = await api.user.updateProfile(user.value.id, payload);

      window.localStorage.setItem('user', JSON.stringify(data));

      await store.dispatch('auth/login', data);

      await showSuccess('Profile successfully updated.')
    } catch (error) {
      logger(error);
      await showError('Something was wrong.');
    } finally {
      finishLoading();
    }
  };

  const changePassword = async (oldPassword, newPassword) => {
    try {
      startLoading();

      await api.user.changePassword(user.value.id, oldPassword, newPassword);

      await showSuccess('Profile successfully updated.')
    } catch (error) {
      logger(error);
      await showError('Something was wrong.');
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

  Object
    .entries(profile)
    .forEach(([prop, value]) => {
      if (value === null) {
        return;
      }

      if (prop === 'month') {
        data.month = value.label;
      }

      return data[prop] = value;
    });

  return data;
}

export function getMonthById(id) {
  return months.find(month => month.value === id);
}

export const months = [
  {label: '01 - January', value: 1},
  {label: '02 - February', value: 2},
  {label: '03 - March', value: 3},
  {label: '04 - April', value: 4},
  {label: '05 - May', value: 5},
  {label: '06 - June', value: 6},
  {label: '07 - July', value: 7},
  {label: '08 - August', value: 8},
  {label: '09 - September', value: 9},
  {label: '10 - October', value: 10},
  {label: '11 - November', value: 11},
  {label: '12 - December', value: 12},
];
