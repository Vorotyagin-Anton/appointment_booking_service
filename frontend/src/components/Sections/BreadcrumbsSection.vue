<template>
  <div class="container main-breadcrumbs">
    <div class="main-breadcrumbs__content">
      <h2 class="main-breadcrumbs__title">{{ breadcrumbs.name }}</h2>

      <breadcrumbs-list :breadcrumbs="breadcrumbs.items"/>

    </div>
  </div>
</template>

<script>
import BreadcrumbsList from "components/Common/BreadcrumbsList";

export default {
  name: "BreadcrumbsSection",

  components: {BreadcrumbsList},

  props: {
    breadcrumbs: {
      type: Object,
      required: true,
    },
  },
}
</script>

<style lang="scss">
.main-breadcrumbs {
  height: 150px;
  background-color: $grey-3;

  &__content {
    height: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 27px;
  }

  &__title {
    font-size: 24px;
    font-weight: 900;
    text-transform: uppercase;
    color: $dark;
  }
}
</style>
