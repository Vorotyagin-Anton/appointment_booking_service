<script setup>
  const props = defineProps({
    service: {
      type: Object,
      required: true,
    }
  });

  const emit = defineEmits(['click']);

  const onClick = () => emit('click', props.service);
</script>

<template>
<q-card
  class="service-card"
  @click="onClick"
>
  <q-img
    class="service-card__img"
    :src="service.pathToPhoto"
  />

  <q-card-section class="service-card__footer">
    {{ service.name }}
  </q-card-section>
</q-card>
</template>

<style lang="scss">
.service-card {
  height: 243px;
  width: 100%;
  max-width: 280px;
  border: 1px solid $grey-4;
  box-shadow: none;

  &__footer {
    display: flex;
    align-items: center;
    height: 60px;
    padding: 0 15px;
    background-color: $grey-2;
    font-size: 15px;
    font-weight: 600;
    color: $grey-9;
    letter-spacing: .3px;
  }
}
</style>
