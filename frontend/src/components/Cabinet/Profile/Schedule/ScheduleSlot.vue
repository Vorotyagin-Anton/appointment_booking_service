<template>
  <div
    class="schedule-slot"
    :class="{
      'schedule-slot_selected': model,
      'schedule-slot_disable': isDisable,
    }"
  >
    <q-checkbox
      class="schedule-slot__checkbox"
      v-model="model"
      :disable="isDisable"
      @update:model-value="updateModel"
    />
    <div class="schedule-slot__time">
      {{ timeSlot.time }} {{ timeSlot.div }}
    </div>
    <div
      class="schedule-slot__status"
      :class="{'schedule-slot__status_active': isActive}"
    >
      {{ status }}
    </div>
  </div>
</template>

<script>
import {computed, ref, toRef, watch} from "vue";

export default {
  name: "ScheduleSlot",

  props: {
    timeSlot: {
      type: Object,
      required: true,
    },

    modelValue: {
      type: Boolean,
      default: false,
    },

    isActive: {
      type: Boolean,
      default: false,
    },

    isDisable: {
      type: Boolean,
      default: true,
    },
  },

  emits: [
    'add',
    'remove',
  ],

  setup(props, {emit}) {
    const isActive = toRef(props, 'isActive');
    const isDisable = toRef(props, 'isDisable');

    const model = ref(isActive.value);

    const status = computed(() => isActive.value ? 'open' : 'close');

    const updateModel = (value) => {
      if (value) {
        emit('add', props.timeSlot.index);
      } else {
        emit('remove', props.timeSlot.index);
      }
    }

    watch(isActive, () => model.value = isActive.value);

    watch(isDisable, () => {
      if (isDisable.value) {
        model.value = false;
      }
    });

    return {
      status,
      model,
      updateModel,
    }
  },
}
</script>

<style lang="scss">
.schedule-slot {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 10px;

  &:hover {
    background-color: $grey-3;
  }

  &_selected {
    background-color: $grey-3;
  }

  &_disable {
    opacity: .5;
  }

  &__checkbox {
    .q-checkbox__inner {
      font-size: 35px;

      &:before {
        background: none !important;
      }
    }
  }

  &__time,
  &__status {
    width: 60px;
    display: flex;
    font-size: 13px;
    color: $grey-9;
  }

  &__status {
    justify-content: flex-end;

    &_active {
      color: $orange;
      font-weight: 500;
    }
  }
}
</style>
