<script setup>
import {useRouter} from "vue-router";

const router = useRouter();

const props = defineProps({
  label: {
    type: String,
    required: true,
  },

  value: {
    type: [String, Number],
    required: true,
  },

  route: {
    type: String,
    default: null,
  },
});

const handleCLick = () => router.push(props.route ? {name: props.route} : {path: '#'});
</script>

<template>
  <div class="sales-item" @click="handleCLick">
    <div class="sales-item__label">{{ label }}</div>
    <div class="sales-item__value">{{ value }}</div>
  </div>
</template>

<style lang="scss">
.sales-item {
  width: 100%;
  min-width: 65px;
  max-width: 225px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  cursor: pointer;

  &:hover > .sales-item__label {
    color: $primary;
  }

  &__label {
    color: $grey-7;
    font-size: 13px;
  }

  &__value {
    color: $dark;
    font-size: 15px;
    font-weight: 500;
  }
}
</style>
