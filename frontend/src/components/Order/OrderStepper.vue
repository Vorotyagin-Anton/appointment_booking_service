<template>
    <q-stepper
      class="order-stepper"
      v-model="currentStep"
      vertical
      animated
      color="primary"
      done-color="positive"
      active-color="primary"
    >
      <order-step
        v-for="step in steps"
        :key="step.data.name"
        :data="step.data"
        :step="currentStep"
        :is-first="isFirstStep(step.data.name)"
        :is-last="isLastStep(step.data.name)"
        @return="setPrevStep"
        @finished="setNextStep"
      >
        <component :is="step.component"/>
      </order-step>
    </q-stepper>
</template>

<script>
import useOrderSteps from "src/hooks/order/useOrderSteps";
import OrderStep from "components/Order/OrderStep";
import {onUpdated} from "vue";
import useMaster from "src/hooks/useMaster";

export default {
  name: "OrderStepper",

  components: {
    OrderStep,
  },

  setup() {
    const {steps, currentStep, setNextStep, setPrevStep, isFirstStep, isLastStep} = useOrderSteps();

    return {
      steps,
      currentStep,
      setNextStep,
      setPrevStep,
      isFirstStep,
      isLastStep,
    }
  },
}
</script>

<style lang="scss">
.order-stepper {
  background-color: $white-2;
}
</style>
