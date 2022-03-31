<template>
    <q-stepper
      class="order-stepper"
      v-model="step"
      vertical
      color="primary"
      animated
    >

      <order-step
        :name="1"
        :step="step"
        :isFirst="true"
        @finished="setNextStep"
      >
        <order-master-card/>
      </order-step>

      <order-step
        :name="2"
        :step="step"
        @finished="setNextStep"
        @return="setPrevStep"
      >
        <order-service-card/>
      </order-step>

      <order-step
        :name="3"
        :step="step"
        @finished="setNextStep"
        @return="setPrevStep"
      >
        <order-time-card/>
      </order-step>

      <order-step
        :name="4"
        :step="step"
        :isLast="true"
        @return="setPrevStep"
      >
        <order-confirm-card/>
      </order-step>
    </q-stepper>
</template>

<script>
import {ref} from "vue";
import OrderStep from "components/Order/OrderStep";
import OrderMasterCard from "components/Order/Cards/OrderMasterCard";
import OrderServiceCard from "components/Order/Cards/OrderServiceCard";
import OrderTimeCard from "components/Order/Cards/OrderTimeCard";
import OrderConfirmCard from "components/Order/Cards/OrderConfirmCard";

export default {
  name: "OrderStepper",

  components: {
    OrderStep,
    OrderMasterCard,
    OrderServiceCard,
    OrderTimeCard,
    OrderConfirmCard,
  },

  setup() {
    const stepsCnt = 4;
    const step = ref(1);

    const setNextStep = (stepNum) => {
      if (stepNum !== stepsCnt) {
        step.value += 1;
      }
    };

    const setPrevStep = (stepNum) => {
      if (stepNum !== step.value) {
        step.value -= 1;
      }
    }

    return {
      step,
      setNextStep,
      setPrevStep,
    }
  },
}
</script>
