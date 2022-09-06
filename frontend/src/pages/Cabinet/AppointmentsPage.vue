<script setup>
import {onMounted} from "vue";
import useAppointments from "src/hooks/appointments/useAppointments";
import AppointmentsTable from "components/Cabinet/Appointments/AppointmentsTable";

const emit = defineEmits(['toggle-left-drawer']);

const {ids, appointments, loading, fetchAppointments} = useAppointments();

onMounted(async () => {
  emit('toggle-left-drawer', {
    isOpen: true,
    isOverlay: false,
  });

  if (ids.value.length === 0) {
    await fetchAppointments()
  }
});
</script>

<template>
  <div class="orders-page">
    <div class="orders-page__wrapper">
      <div v-if="!loading" class="orders-page__content">
        <appointments-table :items="Object.values(appointments)"/>
      </div>

      <div v-else class="orders-page__progress">
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
.orders-page {
  height: 100%;

  &__wrapper {
    height: 100%;
    padding: 15px 35px;
    display: flex;
  }

  &__content {
    min-width: 600px;
    max-width: 1000px;
    width: 100%;
  }

  &__progress {
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  &__empty {
    width: 100%;
    display: flex;
    justify-content: center;
    padding-top: 25px;
    color: $grey-6;
  }
}
</style>
