<template>
  <q-item
    class="schedule-slot"
    :class="{'schedule-slot_selected': model}"
    :disable="isDisable"
    clickable
    @click="toggleSlot"
  >
    <q-item-section class="schedule-slot__section">
      <q-checkbox
        class="schedule-slot__checkbox"
        v-model="model"
        :disable="isDisable"
        @update:model-value="updateModel"
      />
    </q-item-section>

    <q-item-section class="schedule-slot__section schedule-slot__time" avatar>
      {{ timeSlot.time }} {{ timeSlot.div }}
    </q-item-section>

    <q-item-section
      class="schedule-slot__section schedule-slot__status"
      :class="{
        'schedule-slot__status_old': isStatusOld,
        'schedule-slot__status_new': isStatusNew,
      }"
    >
      {{ slotStatus }}
    </q-item-section>
  </q-item>
</template>

<script>
import {computed, ref, toRef, watch} from "vue";
import useSchedule from "src/hooks/user/useSchedule";

export default {
  name: "ScheduleSlot",

  props: {
    timeSlot: {
      type: Object,
      required: true,
    },

    isActive: {
      type: Boolean,
      default: false,
    },

    isDisable: {
      type: Boolean,
      default: true,
    },

    status: {
      type: [String, null],
      default: null,
    }
  },

  emits: [
    'add',
    'remove',
  ],

  setup(props, {emit}) {
    const {STATUS} = useSchedule();

    const isDisable = toRef(props, 'isDisable');
    const isActive = toRef(props, 'isActive');
    const status = toRef(props, 'status');

    const model = ref(isActive.value);

    const slotStatus = computed(() => {
      if (isDisable.value) {
        return 'close';
      }

      if (status.value === STATUS.OLD) {
        return 'open';
      }

      if (status.value === STATUS.NEW) {
        return 'processing';
      }

      return 'close';
    });

    const isStatusNew = computed(() => status.value === STATUS.NEW);
    const isStatusOld = computed(() => status.value === STATUS.OLD);

    const toggleSlot = () => {
      model.value = !model.value;
    };

    const updateModel = (value) => {
      if (value) {
        emit('add', props.timeSlot);
      } else {
        emit('remove', props.timeSlot);
      }
    }

    watch(isActive, () => {
      model.value = isActive.value
    });

    watch(isDisable, () => {
      if (isDisable.value) {
        model.value = false;
      }
    });

    return {
      model,
      slotStatus,
      isStatusNew,
      isStatusOld,
      toggleSlot,
      updateModel,
    }
  },
}
</script>

<style lang="scss">
.schedule-slot {
  padding: 0 20px;
  height: 43px;
  min-height: 43px;
  border-bottom: 1px solid $grey-4;
  font-size: 13px;

  &_selected {
    background-color: $grey-3;
  }

  &__checkbox {
    .q-checkbox__inner {
      font-size: 35px;

      &:before {
        background: none !important;
      }
    }
  }

  &__status {
    display: flex;
    align-items: flex-end;

    &_old {
      color: $orange;
      font-weight: 500;
    }

    &_new {
      color: $green;
      font-weight: 500;
    }
  }
}
</style>
