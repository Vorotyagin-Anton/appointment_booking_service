<script setup>
import {ref} from "vue";
import BannerContainer from "components/Cabinet/Common/BannerContainer";
import TodayList from "components/Cabinet/Banners/Today/TodayList";

const isExpansionOpen = ref(true);
const toggleExpansion = () => isExpansionOpen.value = !isExpansionOpen.value;
</script>

<template>
  <banner-container class="services-banner">
    <q-expansion-item
      class="services-banner__expansion"
      v-model="isExpansionOpen"
      expand-icon-toggle
      expand-separator
    >
      <template v-slot:header>
        <q-item-section
          class="services-banner__header"
          @click="toggleExpansion"
        >
          Today
        </q-item-section>
      </template>

      <today-list/>
    </q-expansion-item>
  </banner-container>
</template>

<style lang="scss">
.services-banner {
  &__expansion {
    max-height: 600px;
    overflow: auto;
  }

  &__header {
    font-size: 20px;
    font-weight: 400;
    color: $dark;
    cursor: pointer;
  }
}
</style>
