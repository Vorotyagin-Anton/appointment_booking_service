<script setup>
import {onMounted} from "vue";
import useSelect from "src/hooks/form/useSelect";
import useCategories from "src/hooks/categories/useCategories";

const emit = defineEmits(['filter']);

// CATEGORIES
const {categories, getFromApi} = useCategories();

const {
  itemsList: categoriesList,
  selectedItems: selectedCategories
} = useSelect(categories);

const applyFilters = () => emit('filter', {
  categories: selectedCategories.value,
});

const resetFilters = () => {
  selectedCategories.value = [];
};

onMounted(() => {
  if (categories.value.length === 0) {
    getFromApi();
  }
});

</script>

<template>
  <div class="services-filters">
    <div class="services-filters__item">
      <div class="services-filters__title">
        CATEGORIES
      </div>

      <q-option-group
        class="services-filters__categories"
        :options="categoriesList"
        type="checkbox"
        v-model="selectedCategories"
      />
    </div>

    <div class="services-filters__item services-filters__btns">
      <q-btn
        class="services-filters__btn"
        color="green"
        label="Use filters"
        unelevated
        @click="applyFilters"
      />

      <q-btn
        class="services-filters__btn"
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
.services-filters {
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
