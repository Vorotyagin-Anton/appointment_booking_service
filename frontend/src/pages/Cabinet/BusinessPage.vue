<script setup>
import {ref, onMounted} from "vue";
import AppAlert from "components/Common/AppAlert";
import AppLoading from "components/Common/AppLoading";
import ServicesSelect from "components/Cabinet/Business/ServicesSelect";
import ServicesTable from "components/Cabinet/Business/ServicesTable";
import useLoading from "src/hooks/common/useLoading";
import useMessage from "src/hooks/common/useMessage";
import logger from "src/helpers/logger";

const services = ref([]);

const handleSelect = (service) => {
  if (!services.value.find(item => item.id === service.id)) {
    services.value.push(service);
  }
};

const removeService = (id) => {
  services.value.splice(services.value.findIndex(item => item.id === id), 1);
};

const {loading, startLoading, finishLoading} = useLoading();
const {visible, type, message, showError, showSuccess, hide} = useMessage();

const submit = async () => {
  try {
    startLoading();
    showSuccess('Profile successfully updated.', 5000);
  } catch (error) {
    logger(error);
    showError('Something was wrong.', 5000);
  } finally {
    finishLoading();
  }
};

const emit = defineEmits(['toggle-left-drawer']);
onMounted(() => emit('toggle-left-drawer', {isOpen: true, isOverlay: false}));
</script>

<template>
  <div class="business-page">
    <app-alert
      :visible="visible"
      :message="message"
      :type="type"
      @hide="hide"
    />

    <app-loading
      v-if="loading"
      title="Loading..."
    />

    <div v-else class="business-page__wrapper">
      <div class="business-page__content">
        <h3 class="business-page__h3">Services</h3>

        <services-select @select="handleSelect"/>
        <services-table
          :services="services"
          @remove="removeService"
        />
      </div>
    </div>
  </div>
</template>

<style lang="scss">
.business-page {
  &__wrapper {
    padding: 35px 55px;
    display: flex;
  }

  &__content {
    min-width: 600px;
    max-width: 1000px;
    width: 100%;
  }

  &__h3 {
    font-size: 18px;
    font-weight: 700;
  }
}
</style>
