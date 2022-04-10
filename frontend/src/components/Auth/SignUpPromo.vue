<template>
  <div class="signup-promo">
    <div class="signup-promo__column">
      <span class="material-icons signup-promo__icon">handshake</span>
      <p class="signup-promo__title">Get started quickly</p>
      <p class="signup-promo__p signup-promo__description">No credit card required, just enter a few basic details about
        your
        business</p>
    </div>

    <div class="signup-promo__column">
      <span class="material-icons signup-promo__icon">date_range</span>
      <p class="signup-promo__title">Book more appointments</p>
      <p class="signup-promo__p signup-promo__description">Clients can book online 24/7 and you can confirm booking
        requests</p>
    </div>

    <div class="signup-promo__column">
      <span class="material-icons signup-promo__icon">notifications_none</span>
      <p class="signup-promo__title">Reduce no shows</p>
      <p class="signup-promo__p signup-promo__description">Send automated reminders and require a credit card for online
        booking</p>
    </div>
  </div>
</template>

<script>
export default {
  name: "SignUpPromo",
}
</script>

<style lang="scss">
.signup-promo {
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
