<script setup>
import RegisterForm from "components/Auth/RegisterForm";
</script>

<template>
  <div class="register">
    <div class="register__content">
      <div class="register__header">
        <h2 class="register__heading">Start Using Square Appointments for Free</h2>
        <p class="register__description">Signing up for Square is fast and free — no commitments or long-term contracts.</p>
      </div>

      <div class="register-promo">
        <div class="register-promo__column">
          <span class="material-icons register-promo__icon">handshake</span>
          <p class="register-promo__title">Get started quickly</p>
          <p class="register-promo__p register-promo__description">No credit card required, just enter a few basic details about
            your
            business</p>
        </div>

        <div class="register-promo__column">
          <span class="material-icons register-promo__icon">date_range</span>
          <p class="register-promo__title">Book more appointments</p>
          <p class="register-promo__p register-promo__description">Clients can book online 24/7 and you can confirm booking
            requests</p>
        </div>

        <div class="register-promo__column">
          <span class="material-icons register-promo__icon">notifications_none</span>
          <p class="register-promo__title">Reduce no shows</p>
          <p class="register-promo__p register-promo__description">Send automated reminders and require a credit card for online
            booking</p>
        </div>
      </div>

      <register-form/>

      <div class="register__signin-link">
        <span class="register-promo__p">Already have a Square account?</span>&nbsp;

        <router-link
          class="register__link"
          :to="{name: 'auth.signin'}"
        >
          Sign In
        </router-link>
      </div>
    </div>
  </div>
</template>

<style lang="scss">
.register {
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

  &__link {
    font-weight: 500;
    color: $blue-8;

    &:hover {
      color: $blue-6;
    }
  }
}

.register-promo {
  display: flex;
  justify-content: space-between;
  width: 100%;
  padding: 25px 0;

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

  &__p {
    font-size: 14px;
    color: $grey-7;
    font-weight: 300;
  }
}
</style>
