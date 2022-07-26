<script setup>
import {ref} from "vue";
import ServicesRow from "components/Cabinet/Business/ServicesRow";
import ServicesModal from "components/Cabinet/Business/ServicesModal";
import ServicesRowContent from "components/Cabinet/Business/ServicesRowContent";

const props = defineProps({
  services: {
    type: Array,
    required: true,
  },
});

const emit = defineEmits([
  'toggle', 'remove',
]);

const serviceModal = ref(false);
const currentService = ref(null);

const openServiceModal = (service) => {
  currentService.value = service;
  serviceModal.value = true;
}

const removeService = (id) => {
  emit('remove', id);
};

const toggleService = (payload) => {
  emit('toggle', payload);
};
</script>

<template>
  <div class="services-table">
    <services-row>
      <template v-slot:status>
        <span class="services-table__col services-table__title">Active</span>
      </template>
      <template v-slot:name>
        <span class="services-table__col services-table__title">Name</span>
      </template>
      <template v-slot:duration>
        <span class="services-table__col services-table__title">Duration</span>
      </template>
      <template v-slot:price>
        <span class="services-table__col services-table__title">Price</span>
      </template>
      <template v-slot:description>
        <span class="services-table__col services-table__title">Description</span>
      </template>
      <template v-slot:image>
        <span class="services-table__col services-table__title">Image</span>
      </template>
      <template v-slot:actions>
        <span class="services-table__col services-table__title">Actions</span>
      </template>
    </services-row>

    <services-row-content
      v-for="service in services"
      :key="service.name"
      :service="service"
      @select="openServiceModal"
      @toggle="toggleService"
      @remove="removeService"
    />
  </div>

  <ServicesModal
    v-model="serviceModal"
    :service="currentService"
  />
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
  }

  &__title {
    font-weight: 500;
  }

  &__description {
    white-space: pre-line;
  }

  &__img {
    max-height: 40px;
    cursor: pointer;
  }

  &__actions {
    justify-content: flex-end;
  }

  &__icon {
    font-size: 20px;
    margin-left: 5px;
    margin-right: 8px;
    cursor: pointer;
    transition: all .3s;

    &:active {
      transform: scale(.8);
    }
  }

  &__edit {
    color: $primary;
  }

  &__delete {
    color: $red-7;
  }
}
</style>
