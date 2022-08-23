<script setup>
import {ref
} from "vue";
import usePasswordInput from "src/hooks/form/usePasswordInput";
import logger from "src/logger";
import useLoading from "src/hooks/common/useLoading";
import useProfile from "src/hooks/user/useProfile";

const props = defineProps({
  model: {
    type: Boolean,
    default: false,
  },

  user: {
    type: Object,
    required: true,
  },
});

const emit = defineEmits([
  'update:modelValue', 'success', 'error',
]);


const model = ref(props.model);
const updateModel = () => emit('update:modelValue', model.value);

const {changePassword} = useProfile(props.user);
const {loading, startLoading, finishLoading} = useLoading();

const {
  pass: oldPass,
  passRules: oldPassRules,
} = usePasswordInput();

const {
  pass: newPass,
  passRules: newPassRules,
  passConfirmation,
  passConfirmationRules,
} = usePasswordInput();

const onSuccess = (message) => emit('success', message);
const onError = (message) => emit('error', message);

const submitPasswordChanges = async () => {
  try {
    startLoading();
    await changePassword(oldPass.value, newPass.value);
    onSuccess('Password successfully changed.');
    resetPasswordChanges();
  } catch (error) {
    logger(error);
    onError('Something was wrong.');
  } finally {
    finishLoading();
  }
};

const resetPasswordChanges = () => {
  oldPass.value = '';
  newPass.value = '';
  passConfirmation.value = '';
  model.value = false;
};
</script>

<template>
  <q-dialog
    class="profile-password-form"
    v-model="model"
    @update:model-value="updateModel"
  >
    <q-card class="profile-password-form__card">
      <q-card-section>
        <div class="text-h6 profile-password-form__header">Change Password</div>

        <label>
          <span class="profile-password-form__label">Enter old password</span>
          <q-input
            class="profile-password-form__input"
            placeholder="Old password"
            type="password"
            v-model="oldPass"
            :rules="oldPassRules"
            :dense="true"
            outlined
          />
        </label>

        <label>
          <span class="profile-password-form__label">Create a new password</span>
          <q-input
            class="profile-password-form__input"
            placeholder="New password"
            type="password"
            v-model="newPass"
            :rules="newPassRules"
            :dense="true"
            outlined
          />
        </label>

        <label>
          <span class="profile-password-form__label">Confirm new password</span>
          <q-input
            class="profile-password-form__input"
            placeholder="Password confirmation"
            type="password"
            v-model="passConfirmation"
            :rules="passConfirmationRules"
            :dense="true"
            outlined
          />
        </label>
      </q-card-section>

      <q-card-actions align="right">
        <q-btn
          flat
          outline
          label="Cancel"
          v-close-popup
          @click="resetPasswordChanges"
        />

        <q-btn
          flat
          label="Submit"
          color="primary"
          v-close-popup
          :loading="loading"
          @click="submitPasswordChanges"
        />
      </q-card-actions>
    </q-card>
  </q-dialog>
</template>

<style lang="scss">
.profile-password-form {
  &__card {
    width: 450px;
    padding: 0 15px;
  }

  &__header {
    margin: 10px 0 15px;
  }

  &__input {
    margin-top: 5px;
  }
}
</style>
