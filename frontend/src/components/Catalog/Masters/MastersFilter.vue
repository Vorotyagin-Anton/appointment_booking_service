<template>
  <div class="masters-filter">
    <div class="masters-filter__item">
      <div class="masters-filter__title">
        CATEGORIES
      </div>

      <q-option-group
        class="masters-filter__categories"
        :options="categoriesList"
        type="checkbox"
        v-model="selectedCategories"
      />
    </div>

    <div class="masters-filter__item masters-filter__services">
      <q-select
        class="masters-filter__select"
        v-model="selectedServices"
        use-input
        use-chips
        multiple
        square
        dense
        label="SERVICES"
        bg-color="white"
        virtual-scroll-slice-size="10"
        :options-dense="true"
        :options="filteredServices"
        @filter="servicesFilter"
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

<script>
import {computed, ref} from "vue";
import useCategories from "src/hooks/categories/useList";
import useServices from "src/hooks/services/useList";
import useSelect from "src/hooks/form/useSelect";

export default {
  name: "MastersFilter",

  emits: ['filter'],

  setup(props, {emit}) {
    const days = ref([]);
    const calendarTitle = computed(() => days.value.length === 0 ? 'BOOKING DATES' : null);
    const calendarSubtitle = computed(() => days.value.length === 0 ? ' ' : null);

    // CATEGORIES
    const {categories} = useCategories();

    const {
      itemsList: categoriesList,
      selectedItems: selectedCategories
    } = useSelect(categories);

    // SERVICES
    const {services} = useServices();

    const {
      selectedItems: selectedServices,
      filteredItems: filteredServices,
      filterFn: servicesFilter,
    } = useSelect(services);

    const applyFilters = () => emit('filter', {
      categories: selectedCategories.value,
      services: selectedServices.value.map(service => service.value),
      days,
    });

    const resetFilters = () => {
      selectedCategories.value = [];
      selectedServices.value = [];
      days.value = [];
    }

    return {
      days,
      calendarTitle,
      calendarSubtitle,
      categoriesList,
      selectedCategories,
      selectedServices,
      filteredServices,
      servicesFilter,
      applyFilters,
      resetFilters,
    }
  }
}
</script>

<style lang="scss">
.masters-filter {
  display: flex;
  flex-direction: column;

  &__item {
    margin-bottom: 35px;
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

  &__categories {
    padding-left: 5px;
    color: $grey-9;
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
</style>
