<template>
  <div class="signup">
    <div class="signup__content">
      <div class="signup__header">
        <h2 class="signup__heading">Start Using Square Appointments for Free</h2>
        <p class="signup__description">Signing up for Square is fast and free — no commitments or long-term contracts.</p>
      </div>

      <sign-up-promo/>

      <sign-up-form/>
    </div>
  </div>
</template>

<script>
import SignUpPromo from "components/Auth/SignUpPromo";
import SignUpForm from "components/Auth/SignUpForm";

export default {
  name: "SignUpPage",

  components: {
    SignUpPromo,
    SignUpForm,
  },
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
}
</style>
