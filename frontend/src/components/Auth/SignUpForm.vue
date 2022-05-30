<template>
  <q-form
    class="signup-form"
    @submit="onSubmit"
    @reset="onReset"
  >
    <div class="signup-form__inputs">
      <div class="signup-form__email">

        <label>
          <span class="signup-form__label">Enter your email</span>
          <q-input
            class="signup-form__input"
            placeholder="you@example.com"
            name="name"
            v-model="email"
            :rules="emailRules"
            :dense="true"
            outlined
          />
        </label>

        <label>
          <span class="signup-form__label">Confirm your email</span>
          <q-input
            class="signup-form__input"
            placeholder="you@example.com"
            v-model="emailConfirmation"
            :rules="emailConfirmationRules"
            :dense="true"
            outlined
          />
        </label>
      </div>

      <div class="signup-form__password">

        <label>
          <span class="signup-form__label">Create a password</span>
          <q-input
            class="signup-form__input"
            placeholder="password"
            name="password"
            type="password"
            v-model="pass"
            :rules="passRules"
            :dense="true"
            outlined
          />
        </label>

        <label>
          <span class="signup-form__label">Confirm your password</span>
          <q-input
            class="signup-form__input"
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

    <div class="signup-form__checkboxes">
      <label class="signup-form__checkbox signup-form__checkbox_master">
        <q-checkbox
          v-model="isMaster"
          name="isMaster"
          :dense="true"
        />

        <div class="signup-form__agrees">
          Register as a master for commercial activities
        </div>
      </label>

      <label class="signup-form__checkbox signup-form__checkbox_agree">
        <q-checkbox
          v-model="agree"
          name="agree"
          :dense="true"
        />

        <div class="signup-form__agrees">
          I agree to Square’s
          <router-link class="signup-form__link" to="main">Terms</router-link>&nbsp;
          <router-link class="signup-form__link" to="main">Privacy Policy</router-link>
          ,
          and
          <router-link class="signup-form__link" to="main">Terms of Service</router-link>
          apply.
        </div>
      </label>
    </div>

    <div class="signup-form__control">
      <div class="signup-form__btns">
        <q-btn
          class="signup-form__btn signup-form__reset"
          outline
          color="black"
          label="Reset"
          type="reset"
          no-caps
        />

        <q-btn
          class="signup-form__btn signup-form__submit"
          color="primary"
          label="Submit"
          type="submit"
          :disable="isRequested"
          no-caps
        />
      </div>

      <div class="signup-form__signin">
        <span class="signup-form__p">Already have a Square account?</span>&nbsp;

        <router-link
          class="signup-form__link"
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
import useAuth from "src/hooks/auth/useAuth";
import useEmailInput from "src/hooks/form/useEmailInput";
import usePasswordInput from "src/hooks/form/usePasswordInput";

export default {
  name: "SignUpForm",

  setup() {
    const {email, emailRules, emailConfirmation, emailConfirmationRules} = useEmailInput();
    const {pass, passRules, passConfirmation, passConfirmationRules} = usePasswordInput();

    const agree = ref(false);
    const isMaster = ref(false);

    const {isRequested, register} = useAuth();

    const onSubmit = () => register(email.value, pass.value, isMaster.value);

    const onReset = () => {
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
      onSubmit,
      onReset,
    }
  }
}
</script>

<style lang="scss">
.signup-form {
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
