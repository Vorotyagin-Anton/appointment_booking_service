<script setup>
import Masters from "components/Catalog/Masters/Masters";
import useBreadcrumbs from "src/hooks/common/useBreadcrumbs";
import BreadcrumbsSection from "components/Sections/BreadcrumbsSection";
import FaqSection from "components/Sections/FaqSection";

const breadcrumbs = useBreadcrumbs('masters');
</script>

<template>
  <div class="masters-page">
    <breadcrumbs-section
      class="masters-page__breadcrumbs"
      :breadcrumbs="breadcrumbs"
    />

    <masters class="masters-page__list"/>
  </div>

  <faq-section/>
</template>

<style lang="scss">
.masters-page {
  &__list  {
    margin: 50px 0;
  }
}
</style>
