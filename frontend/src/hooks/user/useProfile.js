import {ref} from "vue";
import {api} from "boot/api";
import {useStore} from "vuex";
import logger from "src/helpers/logger";
import useLoading from "src/hooks/common/useLoading";
import useMessage from "src/hooks/auth/useMessage";

export default function useProfile(user) {
  const store = useStore();

  const {loading, startLoading, finishLoading} = useLoading();

  const {showError, showSuccess} = useMessage();

  const profile = ref({
    name: user.name ?? null,
    surname: user.surname ?? null,
    middlename: user.middlename ?? null,

    // business
    story: user.story ?? null,

    // contacts
    mobilePhoneNumber: user.mobilePhoneNumber ?? null,
    website: user.website,
    facebook: user.facebook,
    instagram: user.instagram,
    telegram: user.telegram,

    // address
    state: user.state ?? null,
    city: user.city ?? null,
    code: user.code ?? null,
    street: user.street ?? null,
    home: user.home ?? null,

    // birth
    month: user.month ? getMonthById(user.birth.month) : null,
    day: user.day ?? null,
    year: user.year ?? null,
  });

  const updateProfile = async () => {
    try {
      startLoading();

      const payload = parseProfileData(profile.value);

      const data = await api.auth.updateProfile(user.id, payload);

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

  return {
    loading,
    months,
    profile,
    updateProfile,
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

function getMonthById(id) {
  return months.find(month => month.value === id);
}

const months = [
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
