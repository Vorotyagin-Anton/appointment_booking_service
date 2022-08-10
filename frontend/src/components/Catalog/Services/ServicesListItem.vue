<template>
  <q-card class="service-card">
    <q-img :src="item.pathToPhoto"/>
    <q-card-section class="service-card__name">{{ item.name }}</q-card-section>
  </q-card>
</template>

<script>
import {defineComponent} from "vue";

export default defineComponent({
  name: "ServiceListItem",

  props: {
    item: {
      type: Object,
      required: true,
    },
  },
})
</script>

<style lang="scss">
.service-card {
  width: 100%;
  max-width: 280px;
  transition: .4s ease-in-out;

  &:hover {
    transform: scale(1.02);
    cursor: pointer;
  }

  &__name {
    font-size: 16px;
    font-weight: 400;
  }
}
</style>
