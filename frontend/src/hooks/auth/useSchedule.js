import {api} from "boot/api";
import {useStore} from "vuex";
import {computed, ref, watch} from "vue";
import useLoading from "src/hooks/common/useLoading";
import logger from "src/helpers/logger";

export default function useSchedule() {
  const store = useStore();

  const {loading, startLoading, finishLoading} = useLoading();

  const selectedSlots = ref([]);
  const selectedDates = ref([]);

  const STATUS = store.getters['schedule/status'];
  const slots = computed(() => store.getters['schedule/slots']);
  const schedule = computed(() => store.getters['schedule/data']);
  const oldDates = computed(() => store.getters['schedule/oldDates']);
  const newDates = computed(() => store.getters['schedule/newDates']);

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

  const confirmSlotsSelection = async (dates, slots) => {
    if (slots.length > 0) {
      await store.dispatch('schedule/saveSelect', {dates, slots});
    }

    selectedDates.value = [];
  };

  watch(selectedDates, async () => {
    if (selectedDates.value.length === 1) {
      await store.dispatch('schedule/updateSlots', selectedDates.value[0]);
    }

    if (selectedDates.value.length === 0) {
      await store.dispatch('schedule/resetSlots');
    }
  });

  return {
    STATUS,
    loading,
    slots,
    schedule,
    oldDates,
    newDates,
    selectedSlots,
    selectedDates,
    getScheduleFromApi,
    confirmSlotsSelection,
  }
}
