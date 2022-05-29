<template>
  <div class="schedule-page">
    <div class="schedule-page__wrapper">
      <div class="schedule-page__content">

        <schedule-calendar
          class="schedule-page__calendar"
          v-model="selectedDates"
        />

        <div class="schedule-page__description">
          <p class="schedule-page__p">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias atque
            consequuntur, deleniti facilis ipsam libero minus, modi mollitia nam natus, optio quam sit voluptates.
            Facilis, fugit iusto. Lorem ipsum dolor sit amet, consectetur adipisicing elit.
          </p>

          <div class="schedule-page__line">
            <div class="schedule-page__color schedule-page__color_orange"></div>
            <span class="schedule-page__p">
            - Current schedule slots. they are seen by your customers when creating a reservation.
          </span>
          </div>

          <div class="schedule-page__line">
            <div class="schedule-page__color schedule-page__color_green"></div>
            <span class="schedule-page__p">
            - The reservation slots you have chosen. Save schedule changes so your customers can place orders at this time.
          </span>
          </div>
        </div>
      </div>
    </div>

    <q-drawer
      class="schedule-drawer"
      side="right"
      show-if-above
      v-model="drawer"
      :mini="miniDrawer"
      :width="400"
      :mini-width="100"
      :breakpoint="500"
      @click.capture="drawerClick"
      bordered
    >
      <schedule-slots
        class="schedule-page__slots"
        :time-slots="slots"
        :is-dates-selected="selectedDates.length > 0"
        @confirm="handleConfirmation"
        @toggle="toggleDrawer"
      />

      <div class="q-mini-drawer-hide schedule-drawer__btn">
        <q-btn
          icon="chevron_right"
          @click="miniDrawer = true"
          unelevated
          round
          dense
        />
      </div>
    </q-drawer>

    <account-footer
      class="profile-page__footer"
      @confirm="saveChanges"
      @reset="resetSelection"
    />
  </div>
</template>

<script>
import {onMounted, ref, watch} from "vue";
import useAuth from "src/hooks/auth/useAuth";
import useSchedule from "src/hooks/auth/useSchedule";
import AccountFooter from "components/Cabinet/Profile/AccountFooter";
import ScheduleSlots from "components/Cabinet/Schedule/ScheduleSlots";
import ScheduleCalendar from "components/Cabinet/Schedule/ScheduleCalendar";

export default {
  name: "SchedulePage",

  components: {
    ScheduleCalendar,
    ScheduleSlots,
    AccountFooter,
  },

  emits: [
    'toggle-left-drawer',
  ],

  setup(props, {emit}) {
    const drawer = ref(true);
    const miniDrawer = ref(true);

    const toggleDrawer = () => {
      miniDrawer.value = !miniDrawer.value;
    };

    const drawerClick = (event) => {
      if (miniDrawer.value) {
        miniDrawer.value = false;
        event.stopPropagation()
      }
    };

    const {user} = useAuth();

    const {
      loading,
      slots,
      schedule,
      selectedDates,
      confirmSlotsSelection,
      getScheduleFromApi,
    } = useSchedule();

    const resetSelection = () => {
      selectedDates.value = [];
    }

    const handleConfirmation = (slots) => {
      confirmSlotsSelection(selectedDates.value, slots);
    };

    const saveChanges = () => {}

    onMounted(() => {
      emit('toggle-left-drawer', {
        isOpen: false,
        isOverlay: true,
      });

      if (schedule.value.length === 0) {
        getScheduleFromApi(user.id);
      }
    });

    watch(selectedDates, () => {
      if (selectedDates.value.length > 0 && miniDrawer.value) {
        miniDrawer.value = false;
      }
    });

    return {
      drawer,
      miniDrawer,
      toggleDrawer,
      drawerClick,
      loading,
      slots,
      schedule,
      selectedDates,
      handleConfirmation,
      saveChanges,
      resetSelection,
    }
  }
}
</script>

<style lang="scss">
.schedule-page {
  &__wrapper {
    padding: 0 25px;
    display: flex;
    justify-content: center;
  }

  &__content {
    width: 800px;
    align-items: center;
  }

  &__h3 {
    padding: 35px 0 10px;
    font-size: 18px;
    font-weight: 700;
  }

  &__p {
    width: 100%;
  }

  &__calendar {
    margin-top: 25px;
  }

  &__description {
    padding: 0 25px;
    margin-top: 25px;
    font-size: 12px;
  }

  &__line {
    display: flex;
    align-items: center;
    margin-bottom: 5px;
  }

  &__color {
    width: 15px;
    height: 15px;
    border-radius: 50%;
    margin-right: 5px;

    &_orange {
      background-color: $orange;
    }

    &_green {
      background-color: $green;
    }
  }
}

.schedule-drawer {
  padding-bottom: 70px;

  &__h3 {
    font-size: 18px;
    font-weight: 700;
  }

  &__btn {
    position: absolute;
    top: 86px;
    right: 387px;
    z-index: 2000;

    .q-btn {
      height: 26px;
      width: 26px;
      min-height: 0;
      min-width: 0;
      border: 1px solid $grey-4;
      background-color: $white;

      &__content {
        font-size: 14px;
        color: $grey-8;
      }
    }
  }
}
</style>