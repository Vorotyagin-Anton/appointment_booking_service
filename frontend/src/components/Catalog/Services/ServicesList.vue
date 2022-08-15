<script setup>
import {toRef, watch} from "vue";
import useServicesPagination from "src/hooks/services/useServicesPagination";
import ServiceCard from "components/Service/ServiceCard";
import {useRouter} from "vue-router";

const props = defineProps({params: Object});

const params = toRef(props, "params");

const {page, pages, perPage, pagination} = useServicesPagination();

watch(params, () => {
  perPage.value = params.value.offset;
});

const router = useRouter();

const redirectToMaster = (serviceId) => {
  router.push({name: "masters", query: {services: [serviceId]}});
}

const handleSelect = (service) => {
  console.log(service);
  redirectToMaster(service.id);
};
</script>

<template>
  <div class="service-list">
    <div class="service-list__items">
      <service-card
        class="service-list__item"
        v-for="service in pagination"
        :key="service.id"
        :service="service"
        @click="handleSelect"
      />

      <div
        v-if="pages > 1"
        class="service-list__pagination"
      >
        <q-pagination
          boundary-numbers
          v-model="page"
          :max="pages"
          :max-pages="8"
        />
      </div>
    </div>
  </div>
</template>

<style lang="scss">
.service-list {
  &__items {
    display: flex;
    justify-content: flex-start;
    flex-wrap: wrap;
  }

  &__item {
    margin: 10px 5px;
    cursor: pointer;
  }

  &__pagination {
    width: 100%;
    margin-top: 50px;
    display: flex;
    justify-content: center;
  }

  &__loading {
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
  }
}
</style>
