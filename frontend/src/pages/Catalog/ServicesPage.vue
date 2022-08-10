<script setup>
import {onMounted, ref} from "vue";
import useSearch from "src/hooks/masters/useSearch";
import useBreadcrumbs from "src/hooks/common/useBreadcrumbs";
import BreadcrumbsSection from "components/Sections/BreadcrumbsSection";
import MastersSorting from "components/Catalog/Masters/MastersSorting";
import ServicesList from "components/Catalog/Services/ServicesList";
import SearchInput from "components/Common/SearchInput";
import FaqSection from "components/Sections/FaqSection";
import useServices from "src/hooks/services/useServices";

const {getByRoute} = useBreadcrumbs();
const breadcrumbs = getByRoute('services');

const params = ref({
  offset: 12,
});

const applySort = (options) => mergeParams(options);

const mergeParams = (data) => {
  const normalizedData = {};

  for (let prop in data) {
    if (data[prop] != null && data[prop] !== [] && data[prop] !== '') {
      normalizedData[prop] = data[prop];
    }
  }

  params.value = {...params.value, ...normalizedData};
};

const search = useSearch();

const {loading, services, fetchServices} = useServices();

onMounted(() => {
  if (services.value.length === 0) {
    fetchServices();
  }
});
</script>

<template>
  <div class="masters">
    <breadcrumbs-section :breadcrumbs="breadcrumbs"/>

    <div class="container">
      <div class="services__content">

        <div class="services__sidebar">
          <search-input
            class="services__search"
            :search-callback="search"
          />

          <q-separator class="services__separator"/>

          <!-- filters -->
        </div>

        <div class="services__list">
          <masters-sorting
            class="services__sorting"
            @sort="applySort"
          />

          <services-list
            v-if="!loading"
            class="services__items"
            :params="params"
          />

          <div v-else class="services__loading">
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
    </div>
  </div>

  <faq-section/>
</template>

<style lang="scss">
.services {
  &__content {
    display: flex;
    padding: 50px 27px;
  }

  &__sidebar {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 350px;
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
    display: flex;
    margin-bottom: 30px;
  }

  &__list {
    max-width: 885px;
  }

  &__loading {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 500px;
  }
}
</style>
