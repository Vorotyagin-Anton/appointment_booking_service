<template>
  <div class="app-services">
    <div class="app-services__items" v-if="!loading">
      <service-list-item
        v-for="service in services"
        :item="service"
        :key="service.id"
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

<script>
import {defineComponent} from "vue";
import useList from "src/hooks/services/useList";
import ServiceListItem from "components/Catalog/ServiceListItem";

export default defineComponent({
  name: "ServiceList",

  components: {
    ServiceListItem,
  },

  setup() {
    const {loading, services} = useList();

    return {
      loading,
      services,
    }
  }
})
</script>

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
