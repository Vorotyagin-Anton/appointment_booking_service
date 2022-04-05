<template>
  <q-page>
    <slider-promo/>
    <catalog-tabs/>
    <order-modal/>
  </q-page>
</template>

<script>
import {defineComponent} from "vue";
import SliderPromo from "components/SliderPromo";
import CatalogTabs from "components/Catalog/CatalogTabs";
import OrderModal from "components/Order/OrderModal";

export default defineComponent({
  name: 'IndexPage',

  components: {
    SliderPromo,
    CatalogTabs,
    OrderModal,
  },
})
</script>
