import {api} from "boot/api";
import {useStore} from "vuex";
import {computed} from "vue";
import useLoading from "src/hooks/common/useLoading";
import logger from "src/helpers/logger";
import useMessage from "src/hooks/common/useMessage";
import moment from "moment";

export default function useSchedule() {
  const store = useStore();

  const {loading, startLoading, finishLoading} = useLoading();

  const {showError, showSuccess} = useMessage();

  const STATUS = store.getters['schedule/status'];
  const slots = computed(() => store.getters['schedule/slots']);
  const schedule = computed(() => store.getters['schedule/data']);
  const oldDates = computed(() => store.getters['schedule/oldDates']);
  const newDates = computed(() => store.getters['schedule/newDates']);
  const selectedDates = computed(() => store.getters['schedule/selectedDates']);
  const selectedSlots = computed(() => store.getters['schedule/selectedSlots']);

  const getScheduleFromApi = async (userId) => {
    try {
      startLoading();

      const data = await api.schedule.getByUserId(userId);

      const parsedData = parseScheduleFromServer(data);

      await store.dispatch('schedule/putSchedule', parsedData);
    } catch (error) {
      logger(error);
    } finally {
      finishLoading();
    }
  };

  const updateScheduleInApi = async (userId) => {
    try {
      startLoading();

      const data = await api.schedule.updateSchedule(userId, selectedSlots.value);

      const parsedData = parseScheduleFromServer(data);

      await store.dispatch('schedule/putSchedule', parsedData);

      await showSuccess('Schedule successfully updated.', 5000);
    } catch (error) {
      logger(error);
      await showError('Something was wrong.');
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
    selectedSlots,
    getScheduleFromApi,
    updateScheduleInApi,
    handleDatesSelection,
    confirmSlotsChanges,
    resetSelection,
  }
}

function parseScheduleFromServer(schedule) {
  return schedule.map(item => {
    return {
      exact_date: moment(item.date).format('YYYY/MM/DD'),
      slots: item.timeArray.map(time => ({
        id: time.id,
        exact_time_in_minutes: time.value,
        isTimeFree: time.isTimeFree,
      })),
    };
  });
}
