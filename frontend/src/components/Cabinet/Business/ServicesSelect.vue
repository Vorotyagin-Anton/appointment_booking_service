<script setup>
import {onMounted} from "vue";
import useSelect from "src/hooks/form/useSelect";
import useServices from "src/hooks/services/useList";

const {services, loading, getServicesFromApi} = useServices();
const {filteredItems, selectedItems, filterFn} = useSelect(services);

const emit = defineEmits(['select']);

const handleSelect = (value) => emit('select', value);

onMounted(async () => {
  if (services.value.length === 0) {
    await getServicesFromApi();
  }
});
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
  display: flex;
  justify-content: center;
  width: 500px;
  margin-bottom: 25px;

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
