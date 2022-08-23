<script setup>
import useBreadcrumbs from "src/hooks/common/useBreadcrumbs";
import BreadcrumbsSection from "components/Sections/BreadcrumbsSection";
import FaqSection from "components/Sections/FaqSection";
import Services from "components/Catalog/Services/Services";

const breadcrumbs = useBreadcrumbs('services');

</script>

<template>
  <div class="services-page">
    <breadcrumbs-section
      class="services-page__breadcrumbs"
      :breadcrumbs="breadcrumbs"
    />

    <services class="services-page__list"/>
  </div>

  <faq-section/>
</template>

<style lang="scss">
.services-page {
  &__list  {
    margin: 50px 0;
  }
}
</style>
