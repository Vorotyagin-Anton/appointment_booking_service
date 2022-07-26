<script setup>
import {onMounted} from "vue";
import ServicesSettings from "components/Cabinet/Business/ServicesSettings";

const emit = defineEmits([
  'toggle-left-drawer',
]);

onMounted(() => {
  emit('toggle-left-drawer', {
    isOpen: true,
    isOverlay: false,
  });
});
</script>

<template>
  <div class="business-page">
    <div class="business-page__wrapper">
      <div class="business-page__content">
        <services-settings/>
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
}
</style>
