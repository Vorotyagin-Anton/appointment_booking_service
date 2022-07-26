<script setup>
import {ref} from "vue";
import ServicesSelect from "components/Cabinet/Business/ServicesSelect";
import ServicesTable from "components/Cabinet/Business/ServicesTable";

const props = defineProps({
  userServices: {
    type: Array,
    default: () => [],
  },
});

const services = ref(props.userServices);

const handleSelect = (service) => {
  if (!services.value.find(item => item.id === service.id)) {
    services.value.push(service);
  }
};

const toggleService = ({id, status}) => {
  console.log(id, status);
};

const removeService = (id) => {
  const idx = services.value.findIndex(item => item.id === id);
  services.value.splice(idx, 1);
};
</script>

<template>
  <div class="services-settings">
    <h3 class="services-settings__h3">Services</h3>

    <div class="services-settings__list">
      <services-select @select="handleSelect"/>

      <q-btn
        label="New service"
        color="secondary"
        outline
        unelevated
      />
    </div>

    <services-table
      :services="services"
      @toggle="toggleService"
      @remove="removeService"
    />

    <div class="services-settings__btns">
      <q-btn
        label="Submit changes"
        color="primary"
        unelevated
      />
    </div>
  </div>
</template>

<style lang="scss">
.services-settings {
  &__h3 {
    margin-bottom: 25px;
    font-size: 18px;
    font-weight: 700;
  }

  &__list {
    margin-bottom: 15px;
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  &__btns {
    margin-top: 15px;
  }
}
</style>
