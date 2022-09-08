<script setup>
import {computed} from "vue";
import formatPrice from "src/filters/formatPrice";

const props = defineProps({
  item: {
    type: Object,
    required: true,
  },
});

const formattedSum = computed(() => formatPrice(props.item.sum ?? '0.00'));
</script>

<template>
  <q-item class="services-item" clickable v-ripple>
    <q-item-section avatar>
      <q-avatar color="primary" text-color="white">
        <img
          v-if="item.client?.pathToPhoto"
          :src="item.client.pathToPhoto"
          alt="img"
        >
        <span v-else>{{ item.clientName[0] }}</span>
      </q-avatar>
    </q-item-section>

    <q-item-section class="services-item__name">
      <q-item-label>{{ item.clientName ?? item.client.name + ' ' + item.client.surname }}</q-item-label>
      <q-item-label caption lines="1">Demo service</q-item-label>
    </q-item-section>

    <q-item-section class="services-item__service">
      <q-item-label caption>{{ item.time }}</q-item-label>
    </q-item-section>

    <q-item-section class="services-item__sum">
      <q-item-label caption>$ {{ formattedSum }}</q-item-label>
    </q-item-section>
  </q-item>
</template>

<style lang="scss">
.services-item {
  width: 100%;
  height: 65px;
  display: flex;
  padding: 0 25px;
  border-bottom: 1px solid $grey-4;

  &:last-child {
    border: none;
  }

  &__name {
    flex: 30000;
  }
}
</style>
