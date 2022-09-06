<script setup>
import {onMounted} from "vue";
import SalesCalendarBanner from "components/Cabinet/Banners/Calendar/SalesCalendarBanner";
import TodayBanner from "components/Cabinet/Banners/Today/TodayBanner";
import useAppointments from "src/hooks/appointments/useAppointments";
import SetupBanner from "components/Cabinet/Banners/Setup/SetupBanner";

const emit = defineEmits(['toggleLeftDrawer']);

const {ids, loading, fetchAppointments} = useAppointments();

onMounted(async () => {
  emit('toggleLeftDrawer', {
    isOpen: true,
    isOverlay: false,
  });

  if (ids.value.length === 0) {
    await fetchAppointments()
  }
});
</script>

<template>
  <div class="cabinet-page">
    <div class="cabinet-page__wrapper">
      <div v-if="!loading" class="cabinet-page__content">
        <div class="cabinet-page__header">
          <h1 class="cabinet-page__heading">Welcome to Booking Service. Here’s your business at a glance.</h1>
        </div>

        <setup-banner class="cabinet-page__banner"/>
        <sales-calendar-banner class="cabinet-page__banner"/>
        <today-banner class="cabinet-page__banner"/>
      </div>

      <div v-else class="cabinet-page__progress">
        <q-circular-progress
          indeterminate
          size="lg"
          color="primary"
          class="q-ma-md"
        />
      </div>
    </div>
  </div>
</template>

<style lang="scss">
.cabinet-page {
  height: 100%;

  &__wrapper {
    height: 100%;
    padding: 15px 35px;
    display: flex;
    justify-content: center;
  }

  &__content {
    max-width: 700px;
    width: 100%;
  }

  &__progress {
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  &__side {
    width: 330px;
  }

  &__heading {
    font-size: 22px;
    font-weight: 500;
  }

  &__banner {
    margin-bottom: 25px;
  }
}
</style>
