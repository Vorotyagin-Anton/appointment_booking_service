<script setup>
import MastersList from "components/Catalog/Masters/MastersList";
import SortingPanel from "components/Catalog/SortingPanel";
import MastersFilters from "components/Catalog/Masters/MastersFilters";
import SearchInput from "components/Common/SearchInput";
import {useRoute} from "vue-router";
import useMasters from "src/hooks/masters/useMasters";
import {onMounted, ref, watch} from "vue";

const route = useRoute();

const filters = ref({offset: 12});

const {loading, page, pagesCnt, items, itemsIds, pagesIds, fetchMasters, flushMasters} = useMasters();

const changePage = (value) => page.value = value;
const applyFilters = (data) => filters.value = {...filters.value, ...data};
const handleSearch = (name) => applyFilters({name});

onMounted(() => {
  filters.value = {...filters.value, ...route.query};
});

watch(filters, async () => {
  await flushMasters();
  await fetchMasters(filters.value);
});

watch(page, async () => {
  if (!pagesIds.value.includes(String(page.value))) {
    await fetchMasters(filters.value);
  }
});
</script>

<template>
  <div class="container masters">
    <div class="masters__sidebar">
      <search-input
        class="masters__search"
        @search="handleSearch"
      />

      <q-separator class="masters__separator"/>

      <masters-filters
        class="masters__filter"
        @filter="applyFilters"
      />
    </div>

    <div class="masters__list">
      <sorting-panel
        class="masters__sorting"
        :order-map="[null, 'Asc', 'Desc']"
        :sort-map="['Name', 'Rating', 'Popularity']"
        :per-page-map="[12, 30, 60, 90]"
        :per-page="filters.offset"
        @sort="applyFilters"
      />

      <masters-list
        v-if="!loading"
        :items="items"
        :items-ids="itemsIds"
        :page="page"
        :pages="pagesCnt"
        @change-page="changePage"
      />

      <div
        v-else
        class="masters__loading"
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
.masters {
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
