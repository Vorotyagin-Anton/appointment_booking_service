<script setup>
import {computed, onMounted, ref} from "vue";
import useCategories from "src/hooks/categories/useCategories";
import useServices from "src/hooks/services/useServices";
import CheckboxGroup from "components/Catalog/CheckboxGroup";
import useFilter from "src/hooks/form/useFIlter";

const emit = defineEmits(['filter']);

const days = ref([]);

const calendarTitle = computed(() => {
  return (!days.value || days.value.length === 0) ? 'BOOKING DATES' : null;
});

const calendarSubtitle = computed(() => {
  return (!days.value || days.value.length === 0) ? ' ' : null;
});

// Categories
const selectedCategories = ref([]);
const {categories, getFromApi} = useCategories();
const {items: categoriesMap} = useFilter(categories);

// Services
const servicesInput = ref('');
const selectedServices = ref([]);
const {page, services, fetchServices} = useServices();
const {items: servicesMap, filterFn} = useFilter(services);

const fetchFn = () => {
  return fetchServices({offset: 12, page: ++page.value});
};

onMounted(() => {
  if (categories.value.length === 0) {
    getFromApi();
  }

  if (services.value.length === 0) {
    fetchServices({offset: 12});
  }
});

const applyFilters = () => emit('filter', {
  categories: selectedCategories.value,
  services: selectedServices.value,
  days,
});

const resetFilters = () => {
  days.value = [];
  selectedServices.value = [];
  selectedCategories.value = [];
  servicesInput.value = '';
}
</script>

<template>
  <div class="masters-filters">
    <checkbox-group
      class="masters-filters__item"
      label="CATEGORIES"
      :options="categoriesMap"
      v-model:select="selectedCategories"
    />

    <checkbox-group
      class="masters-filters__item"
      label="SERVICES"
      :options="servicesMap"
      v-model:select="selectedServices"
      :filter-fn="filterFn"
      :fetch-fn="fetchFn"
    />

    <div class="masters-filters__item">
      <q-date
        class="masters-filters__date"
        v-model="days"
        :title="calendarTitle"
        :subtitle="calendarSubtitle"
        mask="YYYY-MM-DD"
        range
        multiple
        square
      />
    </div>

    <div class="masters-filters__item masters-filters__btns">
      <q-btn
        class="masters-filters__btn"
        color="green"
        label="Use filters"
        unelevated
        @click="applyFilters"
      />

      <q-btn
        class="masters-filters__btn"
        color="white"
        text-color="black"
        label="Reset"
        unelevated
        outline
        @click="resetFilters"
      />
    </div>
  </div>
</template>

<style lang="scss">
.masters-filters {
  display: flex;
  flex-direction: column;

  &__item {
    margin-bottom: 35px;
    padding: 0 35px;
  }

  &__date {
    box-shadow: none;
    border-bottom: 1px solid $grey-4;

    .q-date__header {
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 15px 10px;
      background-color: $white;
      color: $dark;
      border-left: 5px solid $primary;
      border-bottom: 1.5px solid $grey-5;
    }

    .q-date__header-title-label {
      font-size: 18px;
      font-weight: 500;
      color: $primary;
    }
  }

  &__btns {
    display: flex;
    flex-direction: column;
    padding: 15px;
  }

  &__btn {
    margin-bottom: 10px;
  }
}

.q-menu {
  max-height: 350px !important;
}

.options-group {
  padding-left: 5px;
  color: $grey-9;
  max-height: 250px;
  overflow: auto;
}
</style>
