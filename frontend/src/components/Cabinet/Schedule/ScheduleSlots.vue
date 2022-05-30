<template>
  <div class="schedule-slots">
    <div class="schedule-slots__top">
      <q-item class="schedule-slots__header">
        <q-item-section>
          <q-btn
            class="schedule-slots__close-icon"
            icon="arrow_forward_ios"
            flat
            round
            @click="toggleDrawer"
          />
        </q-item-section>

        <div class="schedule-slots__heading">
          <q-item-section class="schedule-slots__title">
            Time Slots
          </q-item-section>

          <q-item-section class="schedule-slots__schedule-icon" avatar>
            <q-btn
              class="schedule-slots__schedule-icon"
              icon="schedule"
              @click="toggleDrawer"
              flat
              round
            />
          </q-item-section>
        </div>
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
  position: relative;
  width: 100%;
  height: 100%;
  padding-top: 100px;

  &__header {
    position: absolute;
    top: 0;
    width: 100%;
    height: 100px;
    padding-left: 20px;
    display: flex;
    align-items: center;
    font-size: 18px;
    border-bottom: 1px solid $grey-4;
    background-color: $white;
    z-index: 3000;
  }

  &__heading {
    display: flex;
  }

  &__title {
    font-weight: 500;
  }

  &__close-icon {
    width: 36px;
    height: 36px;
    min-height: 36px;
    min-width: 36px;
    box-shadow: none;

    .q-icon {
      font-size: 24px;
      color: $grey-7;
    }
  }

  &__schedule-icon {
    .q-icon {
      font-size: 30px;
    }
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

  &__status {
    display: flex;
    align-items: flex-end;
  }

  &__list {
    height: 100%;
    overflow: auto;
  }

  &__bottom {
    position: absolute;
    bottom: 0;
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
