<script setup>
import {onMounted, ref} from "vue";
import ServicesSettings from "components/Cabinet/Services/ServicesSettings";
import useAuth from "src/hooks/user/useAuth";
import useWorkerServices from "src/hooks/services/useWorkerServices";
import useServices from "src/hooks/services/useServices";

const emit = defineEmits([
  'toggle-left-drawer',
]);

const {user} = useAuth();
const {loading, workerServices, fetchServices} = useWorkerServices();

onMounted(async () => {
  emit('toggle-left-drawer', {
    isOpen: true,
    isOverlay: false,
  });

  if (workerServices.value.length === 0) {
    await fetchServices(user.value.id);
  }
});

const progress = ref();
</script>

<template>
  <div class="business-page">
    <div class="business-page__wrapper">
      <div v-if="!loading" class="business-page__content">
        <services-settings/>
      </div>

      <div v-else class="business-page__progress">
        <q-circular-progress
          indeterminate
          size="lg"
          color="primary"
          class="q-ma-md"
        />
      </div>
    </div>
  </div>
</template>

<style lang="scss">
.business-page {
  height: 100%;

  &__wrapper {
    height: 100%;
    padding: 15px 35px;
    display: flex;
  }

  &__content {
    min-width: 600px;
    max-width: 1000px;
    width: 100%;
  }

  &__progress {
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }
}
</style>
