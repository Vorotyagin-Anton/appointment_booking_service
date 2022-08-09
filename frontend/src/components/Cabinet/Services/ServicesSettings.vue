<script setup>
import AppAlert from "components/Common/AppAlert";
import AppLoading from "components/Common/AppLoading";
import ServicesTable from "components/Cabinet/Services/ServicesTable";
import ServicesModal from "components/Cabinet/Services/ServicesModal";
import useWorkerServices from "src/hooks/services/useWorkerServices";
import useAuth from "src/hooks/user/useAuth";
import {ref} from "vue";
import useLoading from "src/hooks/common/useLoading";
import useMessage from "src/hooks/common/useMessage";
import logger from "src/logger";

const {user} = useAuth();
const {workerServices, createService, updateService, removeService} = useWorkerServices(user.value.id);

const createModal = ref(false);
const updateModal = ref(false);
const selectedServiceId = ref(null);

const openCreateModal = () => {
  createModal.value = true;
};

const openUpdateModal = (serviceId) => {
  selectedServiceId.value = serviceId;
  updateModal.value = true;
};

const closeUpdateModal = () => {
  selectedServiceId.value = null;
};

const toggleService = (serviceId) => {
  updateService({
    ...workerServices.value.entities[serviceId],
    status: !workerServices.value.entities[serviceId].status,
  })
};

const {loading, startLoading, finishLoading} = useLoading();
const {visible, type, message, showError, showSuccess, hide} = useMessage();

const createWorkerService = (service) => {
  submitWrapper(
    () => createService(user.value.id, service),
    'Profile successfully created.'
  );
};

const updateWorkerService = (service) => {
  submitWrapper(() => updateService(service), 'Profile successfully updated.');
};

const submitWrapper = async (callback, successMsg) => {
  try {
    startLoading();
    await callback();
    showSuccess(successMsg, 5000);
  } catch (error) {
    logger(error);
    showError('Something was wrong.', 5000);
  } finally {
    finishLoading();
  }
}
</script>

<template>
  <app-alert
    :visible="visible"
    :message="message"
    :type="type"
    @hide="hide"
  />

  <app-loading v-if="loading" title="Loading..."/>

  <div class="services-settings">
    <h3 class="services-settings__h3">Services</h3>

    <div class="services-settings__options">
      <q-btn
        label="New service"
        color="secondary"
        outline
        unelevated
        @click="openCreateModal"
      />
    </div>

    <services-table
      :services="workerServices"
      @select="openUpdateModal"
      @toggle="toggleService"
      @remove="removeService"
    />

    <services-modal
      action="update"
      v-if="selectedServiceId"
      v-model="updateModal"
      :service-id="selectedServiceId"
      :on-submit="updateWorkerService"
      @hide="closeUpdateModal"
    />

    <services-modal
      action="create"
      v-model="createModal"
      :on-submit="createWorkerService"
    />
  </div>
</template>

<style lang="scss">
.services-settings {
  &__h3 {
    font-size: 18px;
    font-weight: 700;
  }

  &__options {
    margin-bottom: 10px;
    width: 100%;
    display: flex;
    justify-content: flex-end;
    align-items: center;
  }
}
</style>
