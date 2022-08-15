<script setup>
import {computed, onMounted, ref} from "vue";
import useCategories from "src/hooks/categories/useCategories";
import useServices from "src/hooks/services/useServices";
import useSelect from "src/hooks/form/useSelect";

const emit = defineEmits(['filter']);

const {categories, getFromApi} = useCategories();
const {itemsList: categoriesList, selectedItems: selectedCategories} = useSelect(categories);

const {services, fetchServices} = useServices();
const {itemsList: servicesList, selectedItems: selectedServices,} = useSelect(services);

const days = ref([]);

const calendarTitle = computed(() => {
  return (!days.value || days.value.length === 0) ? 'BOOKING DATES' : null;
});

const calendarSubtitle = computed(() => {
  return (!days.value || days.value.length === 0) ? ' ' : null;
});

const applyFilters = () => emit('filter', {
  categories: selectedCategories.value,
  services: selectedServices.value,
  days,
});

const resetFilters = () => {
  days.value = [];
  selectedCategories.value = [];
  selectedServices.value = [];
}

onMounted(() => {
  if (categories.value.length === 0) {
    getFromApi();
  }

  if (services.value.length === 0) {
    fetchServices();
  }
});
</script>

<template>
  <div class="masters-filter">
    <div class="masters-filter__item">
      <div class="masters-filter__title">
        CATEGORIES
      </div>

      <q-option-group
        class="options-group masters-filter__categories"
        type="checkbox"
        :options="categoriesList"
        v-model="selectedCategories"
      />
    </div>

    <div class="masters-filter__item">
      <div class="masters-filter__title">
        SERVICES
      </div>

      <q-option-group
        class="options-group masters-filter__services"
        type="checkbox"
        :options="servicesList"
        v-model="selectedServices"
      />
    </div>

    <div class="masters-filter__item">
      <q-date
        class="masters-filter__date"
        v-model="days"
        :title="calendarTitle"
        :subtitle="calendarSubtitle"
        mask="YYYY-MM-DD"
        range
        multiple
        square
      />
    </div>

    <div class="masters-filter__item masters-filter__btns">
      <q-btn
        class="masters-filter__btn"
        color="green"
        label="Use filters"
        unelevated
        @click="applyFilters"
      />

      <q-btn
        class="masters-filter__btn"
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
.masters-filter {
  display: flex;
  flex-direction: column;

  &__item {
    margin-bottom: 35px;
    padding: 0 35px;
  }

  &__title {
    width: 100%;
    height: 40px;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    padding: 0 10px;
    border-left: 5px solid $primary;
    border-bottom: 1.5px solid $grey-5;
    font-size: 18px;
    font-weight: 500;
    color: $primary;
  }

  &__select {
    width: 290px;
    border-left: 5px solid $primary;

    .q-field__label {
      left: 10px;
      font-size: 18px;
      font-weight: 500;
      color: $primary;
    }

    .q-field__input {
      padding-left: 10px;
    }
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
