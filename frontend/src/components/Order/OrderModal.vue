<template>
  <q-dialog
    class="order-modal"
    :model-value="isOrderModalOpen"
    @hide="closeOrderModal"
  >
    <q-card class="order-modal__card">
      <q-card-section class="row items-center q-pb-none">
        <q-space/>
        <q-btn
          icon="close"
          flat
          round
          dense
          @click="closeOrderModal"
        />
      </q-card-section>

      <order-stepper/>
    </q-card>
  </q-dialog>
</template>

<script>
import OrderStepper from "components/Order/OrderStepper";
import useOrderModal from "src/hooks/order/useOrderModal";

export default {
  name: "OrderModal",

  components: {
    OrderStepper,
  },

  setup() {
    const {isOrderModalOpen, closeOrderModal} = useOrderModal();

    return {
      isOrderModalOpen,
      closeOrderModal,
    }
  }
}
</script>

<style lang="scss">
.order-modal {
  &__card {
    width: 900px !important;
    max-width: 900px !important;
  }
}
</style>
