<template>
  <q-page class="flex flex-center">
    <slider-promo/>
  </q-page>
</template>

<script>
import { defineComponent } from "vue";
import SliderPromo from "components/SliderPromo";

export default defineComponent({
  name: 'IndexPage',

  components: {
    SliderPromo,
  }
})
</script>
