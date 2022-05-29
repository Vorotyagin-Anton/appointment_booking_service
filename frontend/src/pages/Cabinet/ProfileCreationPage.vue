<template>
  <div class="profile-creation-page">
    <keep-alive>
      <component
        :is="component"
        :is-first="isFirstStep"
        :is-last="isLastStep"
        @next="nextStep"
        @prev="prevStep"
      />
    </keep-alive>
  </div>
</template>

<script>
import ProfileIntro from "components/Auth/Profile/ProfileIntro";
import ProfileType from "components/Auth/Profile/ProfileType";
import ProfileCategory from "components/Auth/Profile/ProfileCategory";
import ProfileForm from "components/Auth/Profile/ProfileForm";
import useStepper from "src/hooks/common/useStepper";

const steps = [
  {
    id: 1,
    component: ProfileIntro,
  },
  {
    id: 2,
    component: ProfileType,
  },
  {
    id: 3,
    component: ProfileCategory,
  },
  {
    id: 4,
    component: ProfileForm,
  },
];

export default {
  name: "ProfileCreationPage",

  setup() {
    const {
      component,
      isFirstStep,
      isLastStep,
      nextStep,
      prevStep,
    } = useStepper(steps);

    return {
      steps,
      component,
      isFirstStep,
      isLastStep,
      nextStep,
      prevStep,
    }
  }
}
</script>
