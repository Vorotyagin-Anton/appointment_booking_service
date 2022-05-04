<template>
  <q-page>
    <promo-section/>
    <catalog-tabs/>
    <faq-component/>
  </q-page>
</template>

<script>
import PromoSection from "components/Sections/PromoSection";
import CatalogTabs from "components/Catalog/CatalogTabs";
import FaqComponent from "components/Sections/FaqSection";

export default {
  name: 'IndexPage',

  components: {
    PromoSection,
    CatalogTabs,
    FaqComponent,
  },
}
</script>
