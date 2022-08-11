import {ref} from "vue";
import {api} from "boot/api";
import {useStore} from "vuex";
import useAuth from "src/hooks/user/useAuth";

export default function useProfile() {
  const store = useStore();
  const {user, authorize} = useAuth();

  const profile = ref({
    avatar: null,
    email: user.value.email,
    name: user.value.name ?? null,
    surname: user.value.surname ?? null,
    middlename: user.value.middlename ?? null,
    story: user.value.story ?? null,
    mobilePhoneNumber: user.value.mobilePhoneNumber ?? null,
    website: user.value.website ?? null,
    facebook: user.value.facebook ?? null,
    instagram: user.value.instagram ?? null,
    telegram: user.value.telegram ?? null,
    state: user.value.state ?? null,
    city: user.value.city ?? null,
    code: user.value.code ?? null,
    street: user.value.street ?? null,
    home: user.value.home ?? null,
  });

  const updateProfile = async () => {
    await authorize();

    if (profile.value.avatar) {
      await api.user.changeAvatar(user.value.id, profile.value.avatar);
      profile.value.avatar = null;
    }

    const payload = parseProfileData(profile.value);
    const data = await api.user.updateProfile(user.value.id, payload);
    await store.dispatch('auth/login', data);
  };

  const changePassword = async (oldPassword, newPassword) => {
    await authorize();
    await api.user.changePassword(user.value.id, oldPassword, newPassword);
  };

  return {
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
