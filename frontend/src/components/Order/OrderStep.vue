<template>
  <q-step
    :name="stepName"
    title="Select campaign settings"
    icon="settings"
    :done="isDone"
  >
    <slot/>

    <q-stepper-navigation>
      <q-btn
        color="primary"
        label="Continue"
        v-if="!isLastStep"
        @click="finishStep"
      />

      <q-btn
        class="q-ml-sm"
        color="primary"
        label="Back"
        v-if="!isFirstStep"
        @click="returnStep"
        flat
      />
    </q-stepper-navigation>
  </q-step>
</template>

<script>
import {ref, toRefs, computed} from "vue";

export default {
  name: "OrderStepperMaster",

  props: {
    name: {
      type: Number,
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
    }
  },

  emits: ["finished", "return"],

  setup(props, {emit}) {
    const {name, step, isFirst, isLast} = toRefs(props);

    const stepName = ref(name.value);
    const currentStep = ref(step.value);

    const isDone = computed(() => currentStep.value > stepName.value);

    const finishStep = () => emit("finished", currentStep.value);
    const returnStep = () => emit("return", currentStep.value);

    return {
      stepName,
      currentStep,
      isDone,
      isFirstStep: isFirst,
      isLastStep: isLast,
      finishStep,
      returnStep,
    }
  }
}
</script>
