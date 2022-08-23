import {api} from "boot/api";
import {computed} from "vue";
import {useStore} from "vuex";
import moment from "moment";
import useAuth from "src/hooks/user/useAuth";

export default function useSchedule() {
  const store = useStore();

  const {authorize} = useAuth();

  const STATUS = store.getters['schedule/status'];
  const slots = computed(() => store.getters['schedule/slots']);
  const schedule = computed(() => store.getters['schedule/data']);
  const oldDates = computed(() => store.getters['schedule/oldDates']);
  const newDates = computed(() => store.getters['schedule/newDates']);
  const selectedDates = computed(() => store.getters['schedule/selectedDates']);
  const selectedSlots = computed(() => store.getters['schedule/selectedSlots']);

  const getScheduleFromApi = async (userId) => {
    await authorize();

    const data = await api.schedule.getByUserId(userId);
    const parsedData = parseScheduleFromServer(data);
    await store.dispatch('schedule/putSchedule', parsedData);
  };

  const updateScheduleInApi = async (userId) => {
    await authorize();

    const data = await api.schedule.updateSchedule(userId, selectedSlots.value);
    const parsedData = parseScheduleFromServer(data);
    await store.dispatch('schedule/putSchedule', parsedData);
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
