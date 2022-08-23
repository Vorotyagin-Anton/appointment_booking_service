<script setup>
import {onMounted, ref, watch} from "vue";
import useServices from "src/hooks/services/useServices";
import SearchInput from "components/Common/SearchInput";
import SortingPanel from "components/Catalog/SortingPanel";
import ServicesFilters from "components/Catalog/Services/ServicesFilters";
import ServicesList from "components/Catalog/Services/ServicesList";
import {useRoute} from "vue-router";

const route = useRoute();

const filters = ref({offset: 12})

const {loading, page, pagesCnt, items, itemsIds, pagesIds, fetchServices, flushServices} = useServices();

const changePage = (value) => page.value = value;
const applyFilters = (data) => filters.value = {...filters.value, ...data};
const handleSearch = (name) => applyFilters({name});

onMounted(() => {
  filters.value = {...filters.value, ...route.query};
});

watch(filters, async () => {
  await flushServices();
  await fetchServices(filters.value);
});

watch(page, async () => {
  if (!pagesIds.value.includes(String(page.value))) {
    await fetchServices(filters.value);
  }
});
</script>

<template>
  <div class="container services">
    <div class="services__sidebar">
      <search-input
        class="services__search"
        @search="handleSearch"
      />

      <q-separator class="services__separator"/>

      <services-filters
        class="services__filters"
        @filter="applyFilters"
      />
    </div>

    <div class="services__list">
      <sorting-panel
        class="services__sorting"
        :sort-map="['Name']"
        :order-map="[null, 'Asc', 'Desc']"
        :per-page-map="[12, 30, 60, 90]"
        :per-page="filters.offset"
        @sort="applyFilters"
      />

      <services-list
        v-if="!loading"
        class="services__items"
        :items="items"
        :items-ids="itemsIds"
        :page="page"
        :pages="pagesCnt"
        @change-page="changePage"
      />

      <div
        v-else
        class="services__loading"
      >
        <q-circular-progress
          reverse
          indeterminate
          size="50px"
          color="light-blue"
          class="q-ma-md"
        />
      </div>
    </div>
  </div>
</template>

<style lang="scss">
.services {
  display: flex;
  height: 100%;
  width: 100%;

  &__sidebar {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    width: 100%;
    max-width: 400px;
    margin-right: 50px;
    padding: 0 15px;
  }

  &__search {
    padding: 0 10px;
    margin-top: 20px;
    width: 100%;
  }

  &__separator {
    margin: 32px 0 50px;
    width: 100%;
  }

  &__sorting {
    width: 100%;
    display: flex;
    margin-bottom: 30px;
  }

  &__list {
    width: 100%;
    padding: 0 15px;
  }

  &__loading {
    height: 100%;
    padding: 250px;
    display: flex;
    justify-content: center;
  }
}
</style>
