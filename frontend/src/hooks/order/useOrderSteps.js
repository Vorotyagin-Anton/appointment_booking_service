import {useStore} from "vuex";
import {computed, ref} from "vue";

export default function useOrderSteps() {
  const store = useStore();

  const steps = computed(() => store.getters['order/getSteps']);

  const currentStep = ref(steps.value[0].data.name);

  const setNextStep = (stepNum) => {
    if (stepNum !== steps.value.length) {
      currentStep.value += 1;
    }
  };

  const setPrevStep = (stepNum) => {
    if (stepNum !== currentStep.value) {
      currentStep.value -= 1;
    }
  };

  const isFirstStep = (stepNum) => {
    return stepNum === steps.value[0].data.name;
  };

  const isLastStep = (stepNum) => {
    const lastStep = steps.value[steps.value.length - 1];
    return stepNum === lastStep.data.name;
  };

  const setStatusDone = (stepNum) => store.dispatch('order/setStepStatusDone', stepNum);
  const setStatusProcess = (stepNum) => store.dispatch('order/setStepStatusProcess', stepNum);

  return {
    steps,
    currentStep,
    setPrevStep,
    setNextStep,
    isFirstStep,
    isLastStep,
    setStatusDone,
    setStatusProcess,
  }
}
