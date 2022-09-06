import {computed} from "vue";
import {useStore} from "vuex";
import {api} from "boot/api";
import useLoading from "src/hooks/common/useLoading";
import logger from "src/logger";
import useAuth from "src/hooks/user/useAuth";

export default function useAppointments() {
  const store = useStore();

  const {user} = useAuth();

  const {loading, startLoading, finishLoading} = useLoading();

  const ids = computed(() => store.getters['appointments/getIds']);
  const appointments = computed(() => store.getters['appointments/get']);

  const fetchAppointments = async () => {
    try {
      startLoading();
      const items = await api.appointments.get(user.value.id);
      await store.dispatch('appointments/put', {items})
    } catch (error) {
      logger(error);
    } finally {
      finishLoading();
    }
  };

  return {
    ids, appointments, loading, fetchAppointments,
  };
}
