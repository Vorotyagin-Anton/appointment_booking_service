<script setup>
import ServicesRow from "components/Cabinet/Services/ServicesRow";
import ServicesRowContent from "components/Cabinet/Services/ServicesRowContent";

const props = defineProps({
  services: {
    type: Object,
    required: true,
  },
});

const emit = defineEmits([
  'select', 'toggle', 'remove',
]);

const selectService = (service) => emit('select', service);
const toggleService = (service) => emit('toggle', service);
const removeService = (id) => emit('remove', id);
</script>

<template>
  <div class="services-table">
    <services-row>
      <template v-slot:status>
        <span class="services-table__col">Status</span>
      </template>
      <template v-slot:name>
        <span class="services-table__col">Name</span>
      </template>
      <template v-slot:duration>
        <span class="services-table__col">Duration</span>
      </template>
      <template v-slot:price>
        <span class="services-table__col">Price</span>
      </template>
      <template v-slot:description>
        <span class="services-table__col">Description</span>
      </template>
      <template v-slot:image>
        <span class="services-table__col">Image</span>
      </template>
      <template v-slot:actions>
        <span class="services-table__col">Actions</span>
      </template>
    </services-row>

    <services-row-content
      v-for="service in services"
      :key="service.id"
      :service="service"
      @select="selectService"
      @toggle="toggleService"
      @remove="removeService"
    />
  </div>
</template>

<style lang="scss">
.services-table {
  border: 1px solid rgba(0, 0, 0, .12);

  &__col {
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: flex-start;
    align-items: center;
    font-weight: 500;
  }
}
</style>
