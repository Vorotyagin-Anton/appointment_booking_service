<template>
  <div class="masters">
    <breadcrumbs-section :breadcrumbs="breadcrumbs"/>
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
