<script setup>
import ServicesListItem from "components/Catalog/Services/ServicesListItem";
import useServicesPagination from "src/hooks/services/useServicesPagination";
import {toRef, watch} from "vue";

const props = defineProps({
  params: Object,
});

const params = toRef(props, "params");

const {page, pages, perPage, pagination} = useServicesPagination();

watch([params], () => {
  perPage.value = params.value.offset;
})

watch([pages], () => {
  console.log(pages.value)
})

</script>

<template>
  <div class="app-services">
    <div class="app-services__items">
      <services-list-item
        class="app-services__item"
        v-for="service in pagination"
        :key="service.id"
        :item="service"
      />

      <div
        v-if="pages > 1"
        class="app-services__pagination"
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
.app-services {
  &__items {
    display: flex;
    justify-content: flex-start;
    flex-wrap: wrap;
  }

  &__item {
    margin: 10px 5px;
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
