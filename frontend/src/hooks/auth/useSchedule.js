import {api} from "boot/api";
import {useStore} from "vuex";
import {computed} from "vue";
import useLoading from "src/hooks/common/useLoading";
import logger from "src/helpers/logger";

export default function useSchedule() {
  const store = useStore();

  const {loading, startLoading, finishLoading} = useLoading();

  const STATUS = store.getters['schedule/status'];
  const slots = computed(() => store.getters['schedule/slots']);
  const schedule = computed(() => store.getters['schedule/data']);
  const oldDates = computed(() => store.getters['schedule/oldDates']);
  const newDates = computed(() => store.getters['schedule/newDates']);
  const selectedDates = computed(() => store.getters['schedule/selectedDates']);

  const getScheduleFromApi = async (userId) => {
    try {
      startLoading();

      const data = await api.schedule.getByUserId(userId);

      await store.dispatch('schedule/putSchedule', data);
    } catch (error) {
      logger(error);
    } finally {
      finishLoading();
    }
  };

  const handleDatesSelection = async (dates) => {
    await store.dispatch('schedule/setDates', dates);
  };

  const confirmSlotsChanges = async (slots) => {
    if (slots.add.length > 0) {
      await store.dispatch('schedule/saveSelect', slots.add);
    }

    if (slots.delete.length > 0) {
      await store.dispatch('schedule/removeSlot', slots.delete);
    }

    await handleDatesSelection([]);
  };

  const resetSelection = async () => {
    await store.dispatch('schedule/resetSelect');
  };

  return {
    STATUS,
    loading,
    slots,
    schedule,
    oldDates,
    newDates,
    selectedDates,
    getScheduleFromApi,
    handleDatesSelection,
    confirmSlotsChanges,
    resetSelection,
  }
}
