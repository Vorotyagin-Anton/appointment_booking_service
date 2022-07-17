import {computed, ref} from "vue";

export default function useStepper(steps) {
  const currentStep = ref(1);

  const component = computed(() => {
    const stepData = steps.find(step => step.id === currentStep.value);
    return stepData.component;
  });

  const isFirstStep = computed(() => {
    return currentStep.value === 1;
  });

  const isLastStep = computed(() => {
    return currentStep.value === steps.length;
  });

  const nextStep = (step = 1) => {
    if (currentStep.value + step > steps.length) {
      return;
    }

    currentStep.value += step;
  };

  const prevStep = (step = 1) => {
    if (currentStep.value - step < 1) {
      return;
    }

    currentStep.value -= step;
  };

  return {
    component,
    currentStep,
    isFirstStep,
    isLastStep,
    nextStep,
    prevStep,
  }
}
