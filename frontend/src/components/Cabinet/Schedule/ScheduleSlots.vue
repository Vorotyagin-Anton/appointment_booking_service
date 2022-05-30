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
        :disable="isDisabled"
      >
        <q-item-section>
          <q-checkbox
            class="schedule-slots__checkbox"
            v-model="checkbox"
            :disable="isDisabled"
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
        :model="checkbox"
        :time-slot="slot"
        :is-disable="isDisabled"
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
        :disable="!isChangesDetected"
        @click="confirmSelection"
        unelevated
        no-caps
      />
    </div>
  </div>
</template>

<script>
import {computed, ref} from "vue";
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

    isDisabled: {
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

    const selectedSlots = ref([]);
    const deletedSlots = ref([]);

    const isChangesDetected = computed(() => {
      return selectedSlots.value.length > 0 || deletedSlots.value.length > 0;
    });

    const handleSelect = (value) => {
      const index = deletedSlots.value.findIndex(slot => slot.index === value.index);

      if (index >= 0) {
        deletedSlots.value.splice(index, 1);
      } else {
        selectedSlots.value.push(value);
      }
    };

    const handleRemove = (value) => {
      const index = selectedSlots.value.findIndex(slot => slot.index === value.index);

      if (index >= 0) {
        selectedSlots.value.splice(index, 1);
      } else {
        deletedSlots.value.push(value);
      }
    };

    const confirmSelection = () => {
      emit('confirm', {
        add: selectedSlots.value,
        delete: deletedSlots.value,
      });

      selectedSlots.value = [];
      deletedSlots.value = [];
    };

    const toggleDrawer = () => {
      emit('toggle');
    };

    return {
      checkbox,
      selectedSlots,
      isChangesDetected,
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
