<template>
  <q-page>
    <promo-section/>
    <catalog-tabs/>
    <order-modal/>
    <faq-component/>
  </q-page>
</template>

<script>
import PromoSection from "components/Sections/PromoSection";
import CatalogTabs from "components/Catalog/CatalogTabs";
import OrderModal from "components/Order/OrderModal";
import FaqComponent from "components/Sections/FaqSection";

export default {
  name: 'IndexPage',

  components: {
    PromoSection,
    CatalogTabs,
    OrderModal,
    FaqComponent,
  },
}
</script>
