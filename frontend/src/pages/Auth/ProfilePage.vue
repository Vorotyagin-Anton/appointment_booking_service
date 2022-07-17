<script setup>
import ProfileIntro from "components/Auth/Profile/ProfileIntro";
import ProfileType from "components/Auth/Profile/ProfileType";
import ProfileForm from "components/Auth/Profile/ProfileForm";
import AppLoading from "components/Common/AppLoading";
import AppAlert from "components/Common/AppAlert";
import useStepper from "src/hooks/common/useStepper";
import useProfile from "src/hooks/user/useProfile";
import {useRouter} from "vue-router";
import useMessage from "src/hooks/common/useMessage";
import logger from "src/helpers/logger";
import useLoading from "src/hooks/common/useLoading";

const steps = [
  {id: 1, component: ProfileIntro},
  {id: 2, component: ProfileType},
  {id: 3, component: ProfileForm},
];

const {
  component,
  isFirstStep,
  isLastStep,
  nextStep,
  prevStep,
} = useStepper(steps);

const next = async (payload) => {
  profile.value = {...profile.value, ...payload};

  if (isLastStep.value) {
    submit();
    return;
  }

  nextStep();
};

const router = useRouter();

const {profile, updateProfile} = useProfile();
const {loading, startLoading, finishLoading} = useLoading();
const {visible, type, message, lifetime, showError, hide} = useMessage();

const submit = async () => {
  try {
    startLoading();
    await updateProfile();
    router.push({name: 'cabinet'});
  } catch (error) {
    logger(error);
    showError('Something was wrong.', 5000);
  } finally {
    finishLoading();
  }
};

const handleError = ({message, lifetime}) => showError(message, lifetime);
</script>

<template>
  <div class="profile-creation-page">
    <app-loading
      v-if="loading"
      title="Updated Loading..."
    />

    <app-alert
      :visible="visible"
      :type="type"
      :message="message"
      :lifetime="lifetime"
      @hide="hide"
    />

    <keep-alive>
      <component
        :is="component"
        :is-first="isFirstStep"
        :is-last="isLastStep"
        @next="next"
        @prev="prevStep"
        @error="handleError"
      />
    </keep-alive>
  </div>
</template>
