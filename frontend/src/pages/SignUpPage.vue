<template>
  <div class="signup">
    <div class="signup__content">
      <div class="signup__header">
        <h2 class="signup__heading">Start Using Square Appointments for Free</h2>
        <p class="signup__p">Signing up for Square is fast and free — no commitments or long-term contracts.</p>
      </div>

      <div class="signup__promo">
        <div class="signup__column">
          <span class="material-icons signup__icon">handshake</span>
          <p class="signup__title">Get started quickly</p>
          <p class="signup__p signup__description">No credit card required, just enter a few basic details about your
            business</p>
        </div>

        <div class="signup__column">
          <span class="material-icons signup__icon">date_range</span>
          <p class="signup__title">Book more appointments</p>
          <p class="signup__p signup__description">Clients can book online 24/7 and you can confirm booking requests</p>
        </div>

        <div class="signup__column">
          <span class="material-icons signup__icon">notifications_none</span>
          <p class="signup__title">Reduce no shows</p>
          <p class="signup__p signup__description">Send automated reminders and require a credit card for online
            booking</p>
        </div>
      </div>

      <q-form
        class="signup__form"
        @submit="onSubmit"
        @reset="onReset"
      >
        <div class="signup__inputs">
          <div class="signup__email">

            <label>
              <span class="signup__label">Enter your email</span>
              <q-input
                class="signup__input"
                input-class="signup__input"
                placeholder="you@example.com"
                name="name"
                v-model="email"
                :rules="emailRules"
                :dense="true"
                outlined
              />
            </label>

            <label>
              <span class="signup__label">Confirm your email</span>
              <q-input
                class="signup__input"
                input-class="signup__input"
                placeholder="you@example.com"
                v-model="emailConfirmation"
                :rules="emailConfirmationRules"
                :dense="true"
                outlined
              />
            </label>
          </div>

          <div class="signup__password">

            <label>
              <span class="signup__label">Create a password</span>
              <q-input
                class="signup__input"
                input-class="signup__input"
                placeholder="password"
                name="password"
                type="password"
                v-model="password"
                :rules="passwordRules"
                :dense="true"
                outlined
              />
            </label>

            <label>
              <span class="signup__label">Confirm your password</span>
              <q-input
                class="signup__input"
                input-class="signup__input"
                placeholder="password"
                type="password"
                v-model="passwordConfirmation"
                :rules="passwordConfirmationRules"
                :dense="true"
                outlined
              />
            </label>
          </div>
        </div>

        <div class="signup__agree">
          <label class="checkbox">
            <q-checkbox
              v-model="agree"
              name="agree"
              :dense="true"
            />

            <div class="checkbox__label">
              I agree to Square’s
              <router-link class="signup__link" to="main">Terms</router-link>&nbsp;
              <router-link class="signup__link" to="main">Privacy Policy</router-link>
              ,
              and
              <router-link class="signup__link" to="main">Terms of Service</router-link>
              apply.
            </div>
          </label>
        </div>

        <div class="signup__control">
          <div class="signup__btns">
            <q-btn
              class="signup__btn signup__reset"
              outline
              color="black"
              label="Reset"
              type="reset"
            />

            <q-btn
              class="signup__btn signup__submit"
              color="primary"
              label="Submit"
              type="submit"
            />
          </div>

          <div class="signup__signin">
            <span class="signup__p">Already have a Square account?</span>&nbsp;
            <router-link class="signup__link" to="main">Sign In</router-link>.
          </div>
        </div>

      </q-form>

    </div>
  </div>
</template>

<script>
import {useQuasar} from 'quasar';
import {computed, ref} from "vue";

export default {
  name: "SignUpPage",

  setup() {
    const $q = useQuasar();

    const email = ref(null);
    const emailRules = [value => value && value.length > 0 || 'Invalid email entered!'];

    const emailConfirmation = ref(null);
    const isEmailConfirmed = computed(() => email.value === emailConfirmation.value);
    const emailConfirmationRules = [() => isEmailConfirmed.value || 'Failed to confirm email!'];

    const password = ref(null);
    const passwordRules = [value => value && value.length >= 6 || 'Please type your password!',];

    const passwordConfirmation = ref(null);
    const isPasswordConfirmed = computed(() => password.value === passwordConfirmation.value);
    const passwordConfirmationRules = [() => isPasswordConfirmed.value || 'Failed to confirm password!'];

    const agree = ref(false);

    const onSubmit = () => {

    };

    const onReset = () => {
      email.value = null;
      emailConfirmation.value = null;
      password.value = null;
      passwordConfirmation.value = null;
      agree.value = false;
    };

    return {
      email,
      emailRules,
      emailConfirmation,
      emailConfirmationRules,
      password,
      passwordRules,
      passwordConfirmation,
      passwordConfirmationRules,
      agree,
      onSubmit,
      onReset,
    }
  }
}
</script>

<style lang="scss">
.signup {
  display: flex;
  flex-direction: column;
  align-items: center;

  &__content {
    display: flex;
    flex-direction: column;
    align-items: center;
    max-width: 800px;
  }

  &__header {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-top: 50px;
  }

  &__heading {
    font-size: 24px;
    margin-bottom: 10px;
    font-weight: 300;
    line-height: 30px;
  }

  &__p {
    font-size: 14px;
    color: $grey-7;
    font-weight: 300;
  }

  &__promo {
    display: flex;
    justify-content: space-between;
    width: 100%;
    padding: 25px 0;
  }

  &__column {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 240px;
    text-align: center;
  }

  &__icon {
    font-size: 40px;
    margin-bottom: 10px;
  }

  &__title {
    font-size: 14px;
  }

  &__description {
    width: 180px;
  }

  &__form {
    display: flex;
    flex-direction: column;
    width: 100%;
  }

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

  &__agree {
    padding: 35px 15px;
    border-bottom: .4px solid $grey-5;
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
}

.checkbox {
  display: flex;
  align-items: center;

  &__label {
    margin-left: 10px;
    font-size: 11px;
    font-weight: 400;
    color: $grey-7;
  }
}
</style>
