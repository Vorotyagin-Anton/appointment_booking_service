<script setup>
import {onMounted} from "vue";
import useServices from "src/hooks/services/useServices";
import ServiceListItem from "components/Catalog/ServiceListItem";

const {loading, services, fetchServices} = useServices();

onMounted(() => {
  if (!loading && services.value.ids.length === 0) {
    fetchServices();
  }
});
</script>

<template>
  <div class="app-services">
    <div class="app-services__items" v-if="!loading">
      <service-list-item
        v-for="id in services.ids"
        :item="services.entities[id]"
        :key="id"
      />
    </div>
    <div v-else class="app-services__loading">
      <q-circular-progress
        reverse
        indeterminate
        size="50px"
        color="light-blue"
        class="q-ma-md"
      />
    </div>
  </div>
</template>

<style lang="scss">
.app-services {
  height: 100%;
  padding: 25px 50px;

  &__items {
    display: flex;
    justify-content: flex-start;
    flex-wrap: wrap;
  }

  &__loading {
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
  }
}
</style>
