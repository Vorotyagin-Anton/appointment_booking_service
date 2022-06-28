<template>

  <DefaultModal :showModal="showModal">

    <template v-slot:body>
      <slot/>
    </template>

    <template v-slot:footer>
      <q-btn flat label="OK" v-close-popup />
    </template>

  </DefaultModal>

</template>

<script>
import DefaultModal from "components/Common/Modal/DefaultModal";
export default {
  name: "OrderResponseModal",
  components: {
    DefaultModal
  },
  props: {
    showModal: {
      type: Boolean,
      default: false
    }
  }
}
</script>

<style scoped>

</style>
