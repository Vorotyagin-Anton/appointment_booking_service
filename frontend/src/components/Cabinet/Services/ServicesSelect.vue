<script setup>
import useSelect from "src/hooks/form/useSelect";
import useServices from "src/hooks/services/useServices";

const emit = defineEmits([
  'select',
]);

const {services} = useServices();

const {filteredItems, selectedItems, filterFn} = useSelect(services.value);

const handleSelect = (value) => {
  emit('select', value);
};
</script>

<template>
  <q-select
    class="services-select"
    dense
    outlined
    use-input
    standout
    v-model="selectedItems"
    :options="filteredItems"
    @update:model-value="handleSelect"
    @filter="filterFn"
  />
</template>

<style lang="scss">
.services-select {
  &__select {
    width: 100%;
  }

  &__option {
    text-transform: capitalize;
    color: $primary;
  }

  &__btn {
    width: 360px;
    height: 40px;
  }
}
</style>
