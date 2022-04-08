<template>
  <q-page>
    <promo-section/>
    <catalog-tabs/>
    <order-modal/>
  </q-page>
</template>

<script>
import PromoSection from "components/Sections/PromoSection";
import CatalogTabs from "components/Catalog/CatalogTabs";
import OrderModal from "components/Order/OrderModal";

export default {
  name: 'IndexPage',

  components: {
    PromoSection,
    CatalogTabs,
    OrderModal,
  },
}
</script>
