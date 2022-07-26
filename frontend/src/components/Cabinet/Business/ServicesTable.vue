<script setup>
import ServicesRow from "components/Cabinet/Business/ServicesRow";
import ServicesModal from "components/Cabinet/Business/ServicesModal";
import {ref} from "vue";

const emit = defineEmits([
  'toggle', 'remove',
]);

const props = defineProps({
  services: {type: Array, required: true},
});

const service = ref(null);

const serviceModal = ref(false);

const openServiceModal = (payload) => {
  service.value = payload;
  serviceModal.value = true;
}

const removeService = (id) => emit('remove', id);
const toggleServiceStatus = (id) => emit('toggle', id);
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

    <ServicesRow v-for="service in services" :key="service.name">
      <template v-slot:status>
        <q-checkbox
          class="service-table__checkbox"
          v-model="service.active"
          @click="() => toggleServiceStatus(service.id)"
        />
      </template>

      <template v-slot:name>
        <span class="services-table__col">
          {{ service.name }}
        </span>
      </template>

      <template v-slot:duration>
        <span class="services-table__col">
          {{ service.duration ?? "30" }} min
        </span>
      </template>

      <template v-slot:price>
        <span class="services-table__col">
          $ {{ service.price ?? "0.00" }}
        </span>
      </template>

      <template v-slot:description>
        <span class="services-table__col services-table__description">
          {{ service.description }}
        </span>
      </template>

      <template v-slot:image>
        <q-img
          class="services-table__img"
          :src="service.pathToPhoto"
        />
      </template>

      <template v-slot:actions>
        <div class="services-table__col services-table__actions">
          <span
            class="material-icons services-table__icon services-table__edit"
            @click="() => openServiceModal(service)"
          >
            edit
          </span>
          <span
            class="material-icons services-table__icon services-table__delete"
            @click="() => removeService(service.id)"
          >
            delete
          </span>
        </div>
      </template>
    </ServicesRow>
  </div>

  <ServicesModal
    v-model="serviceModal"
    :service="service"
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
    font-size: 22px;
    margin-right: 10px;
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
