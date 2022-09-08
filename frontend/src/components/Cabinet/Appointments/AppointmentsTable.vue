<script setup>
import columns from "./columns";
import {computed, ref} from "vue";
import AppointmentsClient from "./AppointmentsClient";
import {useStore} from "vuex";

const store = useStore();

const props = defineProps({
  items: {
    type: Array,
    default: () => [],
  },
});

const rows = ref(props.items);

const pagination = ref({
  page: 1,
  rowsPerPage: 10,
  sortBy: 'desc',
  descending: false,
});

const statusMap = computed(() => store.getters['appointments/getStatusMap']);

const changeStatus = (status, appointmentId) => {
  store.dispatch('appointments/changeStatus', {status, appointmentId});
}
</script>

<template>
  <q-table
    class="appointments-table"
    title="Appointments"
    row-key="id"
    :rows="items"
    :columns="columns"
    v-model:pagination="pagination"
    no-data-label="No appointments yet..."
  >
    <template v-slot:body="props">
      <q-tr :props="props">
        <q-td key="id" :props="props">
          {{ props.row.id }}
        </q-td>

        <q-td class="appointments-table__name" key="client" :props="props">
          {{ props.row.clientName ?? props.row.client.name + ' ' + props.row.client.surname }}
          <span class="material-icons appointments-table__icon">info</span>

          <q-popup-edit
            class="appointments-table__popup"
            v-model="props.row"
            v-slot="scope"
          >
            <appointments-client :data="scope.initialValue"/>
          </q-popup-edit>
        </q-td>

        <q-td key="time" :props="props">
          {{ props.row.time }}
        </q-td>

        <q-td key="contactType" :props="props">
          {{ props.row.clientContactType }}
        </q-td>

        <q-td key="status" :props="props">
          {{ props.row.status.label }}

          <q-popup-edit
            class="appointments-table__popup"
            v-model="props.row.status"
            v-slot="scope"
          >
            <q-select
              class="appointments-table__select"
              v-model="scope.value"
              :options="statusMap"
              @update:model-value="(value) => changeStatus(value, props.row.id)"
              autofocus
              options-dense
              dense
            />
          </q-popup-edit>
        </q-td>
      </q-tr>
    </template>
  </q-table>
</template>

<style lang="scss">
.appointments-table {
  box-shadow: none;

  & .q-table__top {
    height: 100px;
  }

  &__popup {
    max-width: 300px;
    padding: 10px;
    overflow: auto;
  }

  &__name {
    cursor: pointer;
  }

  &__icon {
    margin-left: 3px;
    color: $grey-6
  }
}
</style>
