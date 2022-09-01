<script setup>
import tableColumns from "./tableColumns";
import {ref} from "vue";

const props = defineProps({
  items: {
    type: Array,
    default: () => [],
  },
});

const pagination = ref({
  page: 1,
  rowsPerPage: 10,
  sortBy: 'desc',
  descending: false,
})
</script>

<template>
  <q-table
    class="appointments-table"
    title="Appointments"
    row-key="id"
    :rows="items"
    :columns="tableColumns"
    v-model:pagination="pagination"
    no-data-label="No appointments yet..."
  />
</template>

<style lang="scss">
.appointments-table {
  box-shadow: none;

  & .q-table__top {
    height: 100px;
  }
}
</style>
