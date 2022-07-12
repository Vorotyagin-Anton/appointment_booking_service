<template>
  <div class="profile-creation-page">
    <keep-alive>
      <component
        :is="component"
        :is-first="isFirstStep"
        :is-last="isLastStep"
        @next="next"
        @prev="prevStep"
      />
    </keep-alive>

    <app-loading
      v-if="loading"
      title="Updated Loading..."
    />
  </div>
</template>

<script>
import ProfileIntro from "components/Auth/Profile/ProfileIntro";
import ProfileType from "components/Auth/Profile/ProfileType";
import ProfileForm from "components/Auth/Profile/ProfileForm";
import AppLoading from "components/Common/AppLoading";
import useStepper from "src/hooks/common/useStepper";
import useProfile from "src/hooks/user/useProfile";
import {useRouter} from "vue-router";

const steps = [
  {id: 1, component: ProfileIntro},
  {id: 2, component: ProfileType},
  {id: 3, component: ProfileForm},
];

export default {
  name: "ProfileCreationPage",

  components: {
    AppLoading,
  },

  setup() {
    const {
      component,
      isFirstStep,
      isLastStep,
      nextStep,
      prevStep,
    } = useStepper(steps);

    const {loading, profile, updateProfile} = useProfile();

    const router = useRouter();

    const next = async (payload) => {
      profile.value = {...profile.value, ...payload};

      if (isLastStep.value) {
        await updateProfile();
        await router.push({name: 'cabinet'});
        return;
      }

      nextStep();
    }

    return {
      loading,
      steps,
      component,
      isFirstStep,
      isLastStep,
      next,
      prevStep,
    }
  }
}
</script>
