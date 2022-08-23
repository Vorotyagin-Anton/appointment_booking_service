<script setup>
import {onMounted, ref} from "vue";
import useCategories from "src/hooks/categories/useCategories";
import AccountSelect from "components/Cabinet/Common/AccountSelect";
import useSelect from "src/hooks/form/useSelect";

const emit = defineEmits(['update:modelValue']);

const category = ref(null);

const handleSelect = () => emit('update:modelValue', category.value);

const {categories, getFromApi} = useCategories();

const {itemsList} = useSelect(categories);

onMounted(() => {
  if (categories.value.length === 0) {
    getFromApi();
  }
})
</script>

<template>
<account-select
  label="Categories"
  :options="itemsList"
  v-model="category"
  @update:modelValue="handleSelect"
/>
</template>
