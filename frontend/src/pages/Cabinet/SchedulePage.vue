<template>
  <div class="schedule-page">
    <div class="schedule-page__wrapper">
      <div class="schedule-page__content">

        <schedule-calendar
          class="schedule-page__calendar"
          @update="handleDatesSelection"
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
        :is-disabled="!isDatesSelected"
        @confirm="handleConfirmation"
        @toggle="toggleDrawer"
      />
    </q-drawer>

    <account-footer
      class="profile-page__footer"
      :is-save-disabled="!isSlotsSelected"
      @confirm="saveChanges"
      @reset="resetSelection"
    />

    <auth-alert/>

    <app-loading
      v-if="loading"
      :title="loadingTitle"
    />
  </div>
</template>

<script>
import {computed, onMounted, ref, watch} from "vue";
import useAuth from "src/hooks/user/useAuth";
import useSchedule from "src/hooks/user/useSchedule";
import AccountFooter from "components/Cabinet/Profile/AccountFooter";
import ScheduleSlots from "components/Cabinet/Schedule/ScheduleSlots";
import ScheduleCalendar from "components/Cabinet/Schedule/ScheduleCalendar";
import AuthAlert from "components/Auth/AuthAlert";
import AppLoading from "components/Common/AppLoading";

export default {
  name: "SchedulePage",

  components: {
    AppLoading,
    ScheduleCalendar,
    ScheduleSlots,
    AccountFooter,
    AuthAlert,
  },

  emits: [
    'toggle-left-drawer',
  ],

  setup(props, {emit}) {
    const loadingTitle = ref('');

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
      selectedSlots,
      getScheduleFromApi,
      updateScheduleInApi,
      handleDatesSelection,
      confirmSlotsChanges,
      resetSelection,
    } = useSchedule();

    const isDatesSelected = computed(() => selectedDates.value.length > 0);

    const isSlotsSelected = computed(() => {
      return selectedSlots.value.add.length > 0 || selectedSlots.value.delete.length > 0;
    });

    const handleConfirmation = (slots) => {
      confirmSlotsChanges(slots);
      miniDrawer.value = true;
    };

    const saveChanges = () => {
      loadingTitle.value = 'Update Schedule...';
      updateScheduleInApi(user.value.id);
      resetSelection();
    }

    onMounted(() => {
      emit('toggle-left-drawer', {
        isOpen: false,
        isOverlay: true,
      });

      if (schedule.value.length === 0) {
        loadingTitle.value = 'Loading Schedule...';
        getScheduleFromApi(user.value.id);
      }
    });

    watch(selectedDates, () => {
      if (isDatesSelected.value && miniDrawer.value) {
        miniDrawer.value = false;
      }

      if (!isDatesSelected.value && !miniDrawer.value) {
        miniDrawer.value = true;
      }
    });

    return {
      loading,
      loadingTitle,

      drawer,
      miniDrawer,
      toggleDrawer,
      drawerClick,

      slots,
      schedule,
      isDatesSelected,
      isSlotsSelected,
      handleDatesSelection,
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
  position: relative;
  padding-bottom: 70px;

  &__h3 {
    font-size: 18px;
    font-weight: 700;
  }
}
</style>
