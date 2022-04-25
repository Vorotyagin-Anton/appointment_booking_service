<template>
  <div class="masters">
    <breadcrumbs-section :breadcrumbs="breadcrumbs"/>

    <div class="masters__sidebar">
      <div class="masters-filter">
        <div class="masters-filter__categories"></div>
        <div class="masters-filter__services"></div>
        <div class="masters-filter__date"></div>
      </div>
    </div>

    <div class="masters__content">
      <div class="masters-sorting"></div>
      <div class="masters-list">

      </div>
    </div>
  </div>
</template>

<script>
import useBreadcrumbs from "src/hooks/common/useBreadcrumbs";
import BreadcrumbsSection from "components/Sections/BreadcrumbsSection";

export default {
  name: "MastersPage",

  components: {
    BreadcrumbsSection,
  },

  setup() {
    const {getByName} = useBreadcrumbs();

    const breadcrumbs = getByName('masters');

    return {
      breadcrumbs,
    }
  }
}
</script>

<style lang="scss">
.masters {

}
</style>
