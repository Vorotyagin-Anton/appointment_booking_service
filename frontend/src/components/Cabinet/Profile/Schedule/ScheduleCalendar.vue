<template>
  <div class="schedule-calendar">
    <q-date
      class="schedule-calendar__table"
      v-model="model"
      :events="resolveEvents"
      :event-color="resolveEventColor"
      :title="title"
      :subtitle="subTitle"
      @update:model-value="handleDatesSelect"
      range
      multiple
    />

    <schedule-slots
      class="schedule-calendar__slots"
      :time-slots="slotsMap"
      :is-dates-selected="selectedDates.length > 0"
      @confirm="handleConfirmation"
    />
  </div>
</template>

<script>
import {computed, ref} from "vue";
import useSchedule from "src/hooks/auth/useSchedule";
import ScheduleSlots from "components/Cabinet/Profile/Schedule/ScheduleSlots";

export default {
  name: "ScheduleCalendar",

  components: {
    ScheduleSlots,
  },

  setup() {
    const model = ref(null);

    const title = computed(() => {
      if (model.value === null) {
        return 'Calendar';
      }

      return null;
    });

    const subTitle = computed(() => {
      if (model.value === null) {
        return ' ';
      }

      return null;
    });

    const {
      slotsMap,
      selectedDates,
      scheduleOldDates,
      scheduleNewDates,
      confirmSlotsSelection,
      parseDatesRange,
    } = useSchedule();

    const resolveEvents = (date) => {
      return scheduleOldDates.value.includes(date) || scheduleNewDates.value.includes(date);
    };

    const resolveEventColor = (date) => {
      if (scheduleOldDates.value.includes(date)) {
        return 'orange';
      }

      if (scheduleNewDates.value.includes(date)) {
        return 'green';
      }
    };

    const handleDatesSelect = (value) => {
      const dates = [];

      if (value && value.length > 0) {
        for (let range of value) {
          if (typeof range === 'string') {
            dates.push(range);
            continue;
          }

          const parsedRange = parseDatesRange(range);
          dates.push(...parsedRange);
        }
      }

      selectedDates.value = dates;
    };

    const handleConfirmation = (value) => {
      confirmSlotsSelection(value);
      model.value = null;
    };

    return {
      model,
      title,
      subTitle,
      slotsMap,
      selectedDates,
      handleDatesSelect,
      handleConfirmation,
      resolveEvents,
      resolveEventColor,
    }
  }
}
</script>

<style lang="scss">
.schedule-calendar {
  width: 100%;
  display: flex;
  flex-wrap: wrap;

  &__slots {
    margin-left: 15px;
    flex: .7;
    min-width: 250px;
  }

  &__table {
    flex: 1.3;
    min-width: 400px;
    height: 485px;
    border-radius: 0;
    box-shadow: none;
    border: 1px solid $grey-4;

    .q-date__header {
      border-bottom: 1px solid $grey-4;
      color: $black;
      background-color: $grey-3;
    }

    .q-date__view {
      padding: 0;
    }

    .q-date__navigation {
      height: 50px;
      padding: 15px;
    }

    .q-date__calendar-weekdays {
      padding: 15px;
    }

    .q-date__calendar-days-container {
      height: 100%;

      .q-date__calendar-item {
        padding: 0;

        button {
          padding: 0;
          width: 100%;
          height: 100%;
        }
      }

      .q-date__calendar-days {
        div {
          height: 15% !important;
        }
      }

      .q-date__range {
        &:before {
          top: 0;
          bottom: 0;
        }
      }

      .q-btn--rectangle {
        border-radius: 0;
      }

      .q-date__edit-range-from-to,
      .q-date__edit-range-from,
      .q-date__edit-range-to {
        right: 0;
        left: 0;
        top: 0;
        bottom: 0;

        &:after {
          border-radius: 0;
        }
      }
    }

    .q-date__event {
      width: 50%;
      border-radius: 5px;
      background-color: $orange;
    }
  }
}
</style>
