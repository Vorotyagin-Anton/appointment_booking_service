<template>
  <div class="schedule-slots">
    <div class="schedule-slots__top">
      <div class="schedule-slots__header">
        Time slots
      </div>

      <div class="schedule-slots__columns">
        <q-checkbox
          class="schedule-slots__checkbox"
          v-model="checkbox"
          :disable="!isDatesSelected"
        />
        <div class="schedule-slots__time">Time</div>
        <div class="schedule-slots__status">Status</div>
      </div>
    </div>

    <div class="schedule-slots__list">
      <schedule-slot
        class="schedule-slots__slot"
        v-for="slot in timeSlots"
        :key="slot.index"
        :time-slot="slot"
        :is-active="slot.isActive"
        :is-disable="!isDatesSelected"
        @add="handleSelect"
        @remove="handleRemove"
      />
    </div>

    <div class="schedule-slots__bottom">
      <q-btn
        class="schedule-slots__btn"
        label="Confirm"
        :disable="!isDatesSelected"
        @click="confirmSelection"
        no-caps
      />
    </div>
  </div>
</template>

<script>
import {ref} from "vue";
import ScheduleSlot from "components/Cabinet/Profile/Schedule/ScheduleSlot";

export default {
  name: "ScheduleSlots",

  components: {
    ScheduleSlot,
  },

  props: {
    timeSlots: {
      type: Array,
      required: true,
    },

    isDatesSelected: {
      type: Boolean,
      default: false,
    },
  },

  emits: [
    'confirm',
  ],

  setup(props, {emit}) {
    const checkbox = ref(false);

    const slots = ref([]);

    const handleSelect = (value) => {
      slots.value.push(value);
    };

    const handleRemove = (value) => {
      slots.value.forEach((item, key) => {
        if (item === value) {
          delete slots[key];
        }
      });
    };

    const confirmSelection = () => {
      emit('confirm', slots.value);
      slots.value = [];
    };

    return {
      checkbox,
      handleSelect,
      handleRemove,
      confirmSelection,
    }
  },
}
</script>

<style lang="scss">
.schedule-slots {
  position: relative;
  width: 100%;
  height: 485px;
  border: 1px solid $grey-4;

  &__top {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000;
  }

  &__header {
    height: 50px;
    padding: 10px;
    font-size: 18px;
    background-color: $grey-3;
  }

  &__row {
    border-bottom: 1px solid $grey-4;
  }

  &__columns {
    display: flex;
    justify-content: space-between;
    height: 36px;
    padding: 0 10px;
    background-color: $grey-3;
    border-bottom: 1px solid $grey-4;
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
    display: flex;
    align-items: center;
    width: 60px;
    font-size: 14px;
    font-weight: 500;
    color: $grey-10;
  }

  &__status {
    justify-content: flex-end;
  }

  &__list {
    height: 100%;
    padding-top: 86px;
    padding-bottom: 40px;
    overflow: auto;
  }

  &__slot {
    height: 40px;
    border-bottom: 1px solid $grey-4;

    &:last-child {
      border-bottom: none;
    }
  }

  &__bottom {
    position: absolute;
    left: 0;
    bottom: 0;
    width: 100%;
    z-index: 1000;

    .disabled {
      background-color: $green-3;
      opacity: 100 !important;
    }
  }

  &__btn {
    width: 100%;
    height: 40px;
    background-color: $green;
    border-radius: 0;
    color: $white;
  }
}
</style>
