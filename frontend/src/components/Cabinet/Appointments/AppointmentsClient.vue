<script setup>
const props = defineProps({
  data: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <q-list class="appointments-client">
    <q-item class="appointments-client__item" dense>
      <q-item-section class="appointments-client__label">ID:</q-item-section>
      <q-item-section class="appointments-client__value">{{ data.client?.id }}</q-item-section>
    </q-item>

    <q-item class="appointments-client__item" dense>
      <q-item-section class="appointments-client__label">Name:</q-item-section>
      <q-item-section class="appointments-client__value">
        {{ data.clientName ?? data.client?.name + ' ' + data.client?.surname }}
      </q-item-section>
    </q-item>

    <q-item class="appointments-client__item" dense>
      <q-item-section class="appointments-client__label">Phone:</q-item-section>
      <q-item-section class="appointments-client__value">{{ data.clientPhone ?? data.client?.mobilePhoneNumber }}</q-item-section>
    </q-item>

    <q-item class="appointments-client__item" dense>
      <q-item-section class="appointments-client__label">Email:</q-item-section>
      <q-item-section class="appointments-client__value">{{ data.clientEmail ?? data.client?.email}}</q-item-section>
    </q-item>

    <q-item class="appointments-client__item" dense>
      <q-item-section class="appointments-client__label">Telegram:</q-item-section>
      <q-item-section class="appointments-client__value">{{ data.clientTelegram ?? data.client?.telegram }}</q-item-section>
    </q-item>
  </q-list>
</template>

<style lang="scss">
.appointments-client {
  &__item {
    min-width: 100%;
    min-height: 20px;
    padding: 0;
  }

  &__label {
    flex: 1;
    font-size: 11px;
    font-weight: 500;
  }

  &__value {
    flex: 2;
    font-size: 11px;
  }
}
</style>
