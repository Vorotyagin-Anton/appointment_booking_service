<template>
  <q-date
    class="schedule-calendar"
    v-model="model"
    :events="resolveEvents"
    :event-color="resolveEventColor"
    :title="title"
    :subtitle="subTitle"
    @update:model-value="handleDateSelect"
    range
    multiple
  />
</template>

<script>
import {computed, ref, toRef, watch} from "vue";
import useSchedule from "src/hooks/auth/useSchedule";

export default {
  name: "ScheduleCalendar",

  props: {
    modelValue: {
      type: Array,
      required: true,
    }
  },

  emits: [
    'update:model-value',
  ],

  setup(props, {emit}) {
    const model = ref(props.modelValue);

    const selectedDates = toRef(props, 'modelValue');

    const {oldDates, newDates} = useSchedule();

    const title = computed(() => {
      if (model.value === null) {
        return 'Business Schedule';
      }

      return null;
    });

    const subTitle = computed(() => {
      if (model.value === null) {
        return ' ';
      }

      return null;
    });

    const resolveEvents = (date) => {
      return oldDates.value.includes(date) || newDates.value.includes(date);
    };

    const resolveEventColor = (date) => {
      if (newDates.value.includes(date)) {
        return 'green';
      }

      if (oldDates.value.includes(date)) {
        return 'orange';
      }

      return '';
    };

    const handleDateSelect = (value, reason, details) => {
      const dates = parseDate(value, details);
      emit('update:model-value', dates);
    };

    watch(selectedDates, () => {
      if (selectedDates.value.length === 0) {
        model.value = [];
      }
    });

    return {
      model,
      title,
      subTitle,
      resolveEvents,
      resolveEventColor,
      handleDateSelect,
    }
  },
}

function parseDate(value, details) {
  const dates = [];

  if (value && value.length > 0) {
    for (let range of value) {
      if (typeof range === 'string') {
        dates.push(range);
        continue;
      }

      let {from, to, month, year} = details;

      month = month < 10 ? '0' + month : month;

      for (let i = from.day; i <= to.day; i++) {
        let day = i < 10 ? '0' + i : i;

        dates.push(`${year}/${month}/${day}`);
      }
    }
  }

  return dates;
}
</script>

<style lang="scss">
.schedule-calendar {
  width: 800px;
  height: 800px;
  border-radius: 0;
  box-shadow: none;
  border-bottom: 1px solid $grey-4;

  .q-date__header {
    padding: 15px 35px;
    color: $black;
    background-color: $white;
  }

  .q-date__view {
    padding: 0;
  }

  .q-date__navigation {
    height: 50px;
    padding: 15px 0;
    background-color: $grey-2;
    border-top: none;
  }

  .q-date__calendar-weekdays {
    padding: 15px 0;
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

    .q-date__today {
      box-shadow: none;
      border: 1px solid $grey-4;
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
    width: 15%;
    border-radius: 50%;
    background-color: $orange;
  }
}
</style>
