<template>
  <q-form
    class="register-form"
    @submit="onSubmit"
    @reset="onReset"
  >
    <div class="register-form__inputs">
      <div class="register-form__email">

        <label>
          <span class="register-form__label">Enter your email</span>
          <q-input
            class="register-form__input"
            placeholder="you@example.com"
            name="name"
            v-model="email"
            :rules="emailRules"
            :error="Boolean(error.fields.email)"
            :error-message="error.fields.email"
            :dense="true"
            outlined
          />
        </label>

        <label>
          <span class="register-form__label">Confirm your email</span>
          <q-input
            class="register-form__input"
            placeholder="you@example.com"
            v-model="emailConfirmation"
            :rules="emailConfirmationRules"
            :dense="true"
            outlined
          />
        </label>
      </div>

      <div class="register-form__password">

        <label>
          <span class="register-form__label">Create a password</span>
          <q-input
            class="register-form__input"
            placeholder="password"
            name="password"
            type="password"
            v-model="pass"
            :rules="passRules"
            :error="Boolean(error.fields.password)"
            :error-message="error.fields.password"
            :dense="true"
            outlined
          />
        </label>

        <label>
          <span class="register-form__label">Confirm your password</span>
          <q-input
            class="register-form__input"
            placeholder="password"
            type="password"
            v-model="passConfirmation"
            :rules="passConfirmationRules"
            :dense="true"
            outlined
          />
        </label>
      </div>
    </div>

    <div class="register-form__checkboxes">
      <label class="register-form__checkbox register-form__checkbox_master">
        <q-checkbox
          v-model="isMaster"
          name="isMaster"
          :dense="true"
        />

        <div class="register-form__agrees">
          Register as a master for commercial activities
        </div>
      </label>

      <label class="register-form__checkbox register-form__checkbox_agree">
        <q-checkbox
          v-model="agree"
          name="agree"
          :dense="true"
        />

        <div class="register-form__agrees">
          I agree to Square’s
          <router-link class="register-form__link" to="main">Terms</router-link>&nbsp;
          <router-link class="register-form__link" to="main">Privacy Policy</router-link>
          ,
          and
          <router-link class="register-form__link" to="main">Terms of Service</router-link>
          apply.
        </div>
      </label>
    </div>

    <div class="register-form__control">
      <div class="register-form__btns">
        <q-btn
          class="register-form__btn register-form__reset"
          outline
          color="black"
          label="Reset"
          type="reset"
          no-caps
        />

        <q-btn
          class="register-form__btn register-form__submit"
          color="primary"
          label="Submit"
          type="submit"
          :disable="isRequested"
          no-caps
        />
      </div>

      <div class="register-form__signin">
        <span class="register-form__p">Already have a Square account?</span>&nbsp;

        <router-link
          class="register-form__link"
          :to="{name: 'auth.signin'}"
        >
          Sign In
        </router-link>
      </div>
    </div>

  </q-form>
</template>

<script>
import {ref} from "vue";
import useEmailInput from "src/hooks/form/useEmailInput";
import usePasswordInput from "src/hooks/form/usePasswordInput";
import useRegister from "src/hooks/user/useRegister";
import useForm from "src/hooks/common/useForm";
import useMessage from "src/hooks/user/useMessage";

export default {
  name: "RegisterForm",

  setup() {
    const {email, emailRules, emailConfirmation, emailConfirmationRules} = useEmailInput();
    const {pass, passRules, passConfirmation, passConfirmationRules} = usePasswordInput();

    const agree = ref(false);
    const isMaster = ref(false);

    const register = useRegister();
    const {isRequested, error, submit, reset} = useForm();
    const {showError, hide} = useMessage();

    const onSubmit = async () => {
      await submit(register, email.value, pass.value, isMaster.value);

      if (error.value.message) {
        await showError(error.value.message);
      }
    };

    const onReset = () => {
      hide();
      reset();

      agree.value = false;
      email.value = null;
      pass.value = null;
      emailConfirmation.value = null;
      passConfirmation.value = null;
    };

    return {
      email,
      emailRules,
      emailConfirmation,
      emailConfirmationRules,
      pass,
      passRules,
      passConfirmation,
      passConfirmationRules,
      agree,
      isMaster,
      isRequested,
      error,
      onSubmit,
      onReset,
    }
  }
}
</script>

<style lang="scss">
.register-form {
  display: flex;
  flex-direction: column;
  width: 100%;

  &__inputs {
    display: flex;
    flex-direction: column;
    padding: 30px 0 10px;
    border-top: .4px solid $grey-5;
    border-bottom: .4px solid $grey-5;
  }

  &__email {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
  }

  &__password {
    display: flex;
    justify-content: space-between;
  }

  &__label {
    font-size: 11px;
    font-weight: 400;
    color: $grey-7;
    margin-bottom: 3px;
  }

  &__input {
    width: 350px;
  }

  &__checkboxes {
    padding: 25px 15px;
    border-bottom: .4px solid $grey-5;
  }

  &__checkbox {
    display: flex;
    align-items: center;

    &_master {
      margin-bottom: 10px;
    }
  }

  &__agrees {
    margin-left: 10px;
    font-size: 11px;
    font-weight: 400;
    color: $grey-7;
    cursor: pointer;
  }

  &__link {
    font-weight: 500;
    color: $blue-8;

    &:hover {
      color: $blue-6;
    }
  }

  &__control {
    display: flex;
    flex-direction: column;
    padding: 25px 10px;
  }

  &__btns {
    display: flex;
    justify-content: space-between;
  }

  &__btn {
    width: 325px;
  }

  &__signin {
    margin-top: 35px;
    text-align: center;
  }

  &__p {
    font-size: 14px;
    color: $grey-7;
    font-weight: 300;
  }
}
</style>