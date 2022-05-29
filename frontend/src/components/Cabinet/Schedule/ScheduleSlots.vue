<template>
  <div class="schedule-slots">
    <div class="schedule-slots__top">
      <q-item class="schedule-slots__header">
        <q-item-section
          avatar
          @click="toggleDrawer"
        >
          <span class="material-icons schedule-slots__icon">schedule</span>
        </q-item-section>

        <q-item-section class="schedule-slots__heading" avatar>Time Slots</q-item-section>
      </q-item>

      <q-item
        class="schedule-slots__columns"
        :disable="!isDatesSelected"
      >
        <q-item-section>
          <q-checkbox
            class="schedule-slots__checkbox"
            v-model="checkbox"
            :disable="!isDatesSelected"
          />
        </q-item-section>

        <q-item-section class="schedule-slots__time" avatar>Time</q-item-section>

        <q-item-section class="schedule-slots__status">Status</q-item-section>
      </q-item>
    </div>

    <div class="schedule-slots__list fit">
      <schedule-slot
        class="schedule-slots__slot"
        v-for="slot in timeSlots"
        :key="slot.index"
        :time-slot="slot"
        :is-disable="!isDatesSelected"
        :is-active="slot.isActive"
        :status="slot.status"
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
        unelevated
        no-caps
      />
    </div>
  </div>
</template>

<script>
import {ref} from "vue";
import ScheduleSlot from "components/Cabinet/Schedule/ScheduleSlot";

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

    selectedSlots: {
      type: Array,
      default: () => ([]),
    },

    isDatesSelected: {
      type: Boolean,
      default: false,
    },
  },

  emits: [
    'confirm',
    'toggle',
  ],

  setup(props, {emit}) {
    const checkbox = ref(false);

    const slots = ref([]);

    const handleSelect = (value) => {
      slots.value.push(value);
    };

    const handleRemove = (value) => {
      const index = slots.value.findIndex(slot => slot === value);

      if (index) {
        slots.value.splice(index, 1);
      }
    };

    const confirmSelection = () => {
      emit('confirm', slots.value);
      slots.value = [];
    };

    const toggleDrawer = () => {
      emit('toggle');
    };

    return {
      slots,
      checkbox,
      handleSelect,
      handleRemove,
      confirmSelection,
      toggleDrawer,
    }
  },
}
</script>

<style lang="scss">
.schedule-slots {
  width: 100%;

  &__header {
    height: 100px;
    padding-left: 20px;
    display: flex;
    align-items: center;
    font-size: 18px;
    border-bottom: 1px solid $grey-4;
  }

  &__icon {
    font-size: 32px;
    cursor: pointer;
  }

  &__columns {
    height: 43px;
    min-height: 43px;
    padding: 20px;
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

  }

  &__status {
    display: flex;
    align-items: flex-end;
  }

  &__list {
    height: 100%;
    overflow: auto;
  }

  &__bottom {
    width: 100%;

    .disabled {
      background-color: $green-3;
      opacity: 100 !important;
    }
  }

  &__btn {
    width: 100%;
    height: 40px;
    background-color: $green;
    box-shadow: none;
    border-radius: 0;
    color: $white;
  }
}
</style>
