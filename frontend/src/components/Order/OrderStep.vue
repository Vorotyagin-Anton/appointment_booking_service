<template>
  <q-step
    :name="stepData.name"
    :title="stepData.title"
    icon="settings"
    :done="stepData.done"
    :disable="buttonDisable"
  >
    <slot/>

    <q-stepper-navigation>

      <q-btn
        class="q-ml-sm"
        color="primary"
        label="Back"
        v-if="!isFirstStep"
        @click="returnStep"
        flat
      />

      <q-btn
        :disable="buttonDisable"
        color="primary"
        label="Continue"
        v-if="!isLastStep"
        @click="finishStep"
      />

    </q-stepper-navigation>
  </q-step>
</template>

<script>
import {onUpdated, ref, toRefs, watch} from "vue";
import useOrderSteps from "src/hooks/order/useOrderSteps";
import useMaster from "src/hooks/useMaster";

export default {
  name: "OrderStepperMaster",

  props: {
    data: {
      type: Object,
      required: true,
    },

    step: {
      type: Number,
      required: true,
    },

    isFirst: {
      type: Boolean,
      default: false,
    },

    isLast: {
      type: Boolean,
      default: false,
    },
    // buttonDisable: {
    //   type: Boolean,
    //   default: false
    // }
  },

  emits: ["finished", "return"],

  setup(props, {emit}) {
    const {data, step, isFirst, isLast} = toRefs(props);

    const {setStatusDone, setStatusProcess} = useOrderSteps();

    const { orderInfo } = useMaster();

    const currentStep = ref(step.value);

    const buttonDisable = ref(false)

    const finishStep = () => {
      emit("finished", currentStep.value);
      setStatusDone(data.value.name)
    };

    const returnStep = () => {
      emit("return", currentStep.value);
      setStatusProcess(data.value.name);
    };

    return {
      stepData: data,
      currentStep,
      isFirstStep: isFirst,
      isLastStep: isLast,
      finishStep,
      returnStep,
      buttonDisable
    }
  }
}
</script>
