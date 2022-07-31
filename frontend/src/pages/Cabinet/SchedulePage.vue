<script setup>
import {computed, onMounted, ref, watch} from "vue";
import useAuth from "src/hooks/user/useAuth";
import useSchedule from "src/hooks/user/useSchedule";
import useMessage from "src/hooks/common/useMessage";
import ProfileFooter from "components/Cabinet/Profile/ProfileFooter";
import ScheduleSlots from "components/Cabinet/Schedule/ScheduleSlots";
import ScheduleCalendar from "components/Cabinet/Schedule/ScheduleCalendar";
import AppLoading from "components/Common/AppLoading";
import AppAlert from "components/Common/AppAlert";
import logger from "src/logger";
import useLoading from "src/hooks/common/useLoading";

const emit = defineEmits(['toggle-left-drawer']);

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

const {loading, startLoading, finishLoading} = useLoading();
const {visible, type, message, showError, showSuccess, hide} = useMessage();

const isDatesSelected = computed(() => selectedDates.value.length > 0);

const isSlotsSelected = computed(() => {
  return selectedSlots.value.add.length > 0 || selectedSlots.value.delete.length > 0;
});

const loadSchedule = () => {
  try {
    loadingTitle.value = 'Loading Schedule...';
    startLoading();

    getScheduleFromApi(user.value.id);
  } catch (error) {
    logger(error);
  } finally {
    finishLoading();
  }
};

const handleConfirmation = (slots) => {
  confirmSlotsChanges(slots);
  miniDrawer.value = true;
};

const saveChanges = async () => {
  try {
    loadingTitle.value = 'Update Schedule...';
    await updateScheduleInApi(user.value.id);
    showSuccess('Schedule successfully updated.', 5000);
  } catch (error) {
    logger(error);
    showError('Something was wrong.', 5000);
  } finally {
    finishLoading();
    resetSelection();
  }
};

onMounted(() => {
  emit('toggle-left-drawer', {
    isOpen: false,
    isOverlay: true,
  });

  if (schedule.value.length === 0) {
    loadSchedule();
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
</script>

<template>
  <div class="schedule-page">
    <app-alert
      :visible="visible"
      :message="message"
      :type="type"
      @hide="hide"
    />

    <app-loading v-if="loading" :title="loadingTitle"/>

    <div v-else>
      <div class="schedule-page__wrapper">
        <div class="schedule-page__content">
          <schedule-calendar class="schedule-page__calendar" @update="handleDatesSelection"/>
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

      <profile-footer
        class="profile-page__footer"
        :is-save-disabled="!isSlotsSelected"
        @confirm="saveChanges"
        @reset="resetSelection"
      />
    </div>
  </div>
</template>

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
