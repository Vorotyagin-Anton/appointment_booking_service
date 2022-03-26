<template>
  <q-page>
    <slider-promo/>
    <catalog-tabs/>
  </q-page>
</template>

<script>
import { defineComponent } from "vue";
import SliderPromo from "components/SliderPromo";
import CatalogTabs from "components/Catalog/CatalogTabs";

export default defineComponent({
  name: 'IndexPage',

  components: {
    SliderPromo,
    CatalogTabs,
  }
})
</script>
