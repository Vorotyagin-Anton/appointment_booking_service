import moment from "moment";
import {api} from "boot/api";
import {useStore} from "vuex";
import {computed, ref, watch} from "vue";
import useLoading from "src/hooks/common/useLoading";
import logger from "src/helpers/logger";

export default function useSchedule() {
  const store = useStore();
  const {loading, startLoading, finishLoading} = useLoading()

  const schedule = computed(() => store.getters['schedule/data']);
  const scheduleOldDates = computed(() => store.getters['schedule/oldDates']);
  const scheduleNewDates = computed(() => store.getters['schedule/newDates']);

  const slotsMap = ref(slots);
  const selectedDates = ref([]);

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

  const confirmSlotsSelection = async (slots) => {
    if (slots.length > 0) {
      await store.dispatch('schedule/putSlots', {
        dates: selectedDates.value,
        slots,
      });

      selectedDates.value = [];
    }
  };

  watch(selectedDates, () => {
    let activeSlots = [];

    if (selectedDates.value.length === 1) {
      activeSlots = store.getters['schedule/getSlotsByDate'](selectedDates.value[0]);
    }

    for (let slot of slotsMap.value) {
      slot.isActive = activeSlots.includes(slot.index);
    }
  });

  return {
    loading,
    schedule,
    scheduleOldDates,
    scheduleNewDates,
    slotsMap,
    selectedDates,
    getScheduleFromApi,
    confirmSlotsSelection,
    parseDatesRange,
    normalizeTime,
  }
}

const slots = [
  {time: '00:00', div: 'am', isActive: false, index: 0},
  {time: '01:00', div: 'am', isActive: false, index: 60},
  {time: '02:00', div: 'am', isActive: false, index: 120},
  {time: '03:00', div: 'am', isActive: false, index: 180},
  {time: '04:00', div: 'am', isActive: false, index: 240},
  {time: '05:00', div: 'am', isActive: false, index: 300},
  {time: '06:00', div: 'am', isActive: false, index: 360},
  {time: '07:00', div: 'am', isActive: false, index: 420},
  {time: '08:00', div: 'am', isActive: false, index: 480},
  {time: '09:00', div: 'am', isActive: false, index: 540},
  {time: '10:00', div: 'am', isActive: false, index: 600},
  {time: '11:00', div: 'am', isActive: false, index: 660},
  {time: '12:00', div: 'am', isActive: false, index: 720},
  {time: '01:00', div: 'pm', isActive: false, index: 780},
  {time: '02:00', div: 'pm', isActive: false, index: 840},
  {time: '03:00', div: 'pm', isActive: false, index: 900},
  {time: '04:00', div: 'pm', isActive: false, index: 960},
  {time: '05:00', div: 'pm', isActive: false, index: 1020},
  {time: '06:00', div: 'pm', isActive: false, index: 1080},
  {time: '07:00', div: 'pm', isActive: false, index: 1140},
  {time: '08:00', div: 'pm', isActive: false, index: 1200},
  {time: '09:00', div: 'pm', isActive: false, index: 1260},
  {time: '10:00', div: 'pm', isActive: false, index: 1320},
  {time: '11:00', div: 'pm', isActive: false, index: 1380},
];

/**
 * @param range - {from: 2022/01/01, to: 2022/01/02}
 */
function parseDatesRange(range) {
  const dates = [];

  const from = parseInt(range.from.substr(-2));
  const to = parseInt(range.to.substr(-2));
  const slice = range.from.substr(0, 8);

  for (let i = from; i <= to; i++) {
    let day = String(i);

    if (day.length === 1) {
      day = '0' + day;
    }

    dates.push(slice + day);
  }

  return dates;
}

/**
 * @param minutes - minutes after the start of the day
 * @param date - [year, month, day]
 */
function normalizeTime(minutes, date) {
  return moment(date).add(minutes, 'minutes');
}
