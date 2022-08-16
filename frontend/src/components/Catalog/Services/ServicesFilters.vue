<script setup>
import {computed, onMounted, ref} from "vue";
import useCategories from "src/hooks/categories/useCategories";
import CheckboxGroup from "components/Catalog/CheckboxGroup";

const emit = defineEmits(['filter']);

const {categories, getFromApi} = useCategories();

const selectedCategories = ref([]);

const categoriesMap = computed(() => categories.value.map(item => ({
  value: item.id,
  label: item.name,
  ...item
})));

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
    <checkbox-group
      label="CATEGORIES"
      class="services-filters__item"
      :options="categoriesMap"
      v-model:select="selectedCategories"
    />

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
