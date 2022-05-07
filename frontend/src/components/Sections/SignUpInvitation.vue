<template>
  <app-section class="signup-invitation">
    <div class="signup-invitation__content">
      <app-section-header
        class="signup-invitation__header"
        heading="Start booking appointments."
        description="No credit card required. No long-term commitments."
      />

      <router-link :to="{name: 'signup'}">
        <q-btn
          class="signup-invitation__btn"
          color="white"
          label="Sign up free"
          no-caps
        />
      </router-link>
    </div>
  </app-section>
</template>

<script>
import AppSection from "components/Common/AppSection";
import AppSectionHeader from "components/Common/AppSectionHeader";

export default {
  name: "SignUpSection",

  components: {
    AppSection,
    AppSectionHeader,
  },
}
</script>

<style lang="scss">
.signup-invitation {
  height: 500px;
  background-color: $blue-500;

  &__content {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%;
  }

  &__header {
    color: $white;
    margin-bottom: 25px;
  }

  &__btn {
    width: 135px;
    height: 50px;
    transition-property: background-color;
    transition-duration: .5s;

    .q-btn__content {
      font-size: 16px;
      color: $blue-500;
    }

    &:hover {
      background-color: $grey-3 !important;
    }
  }
}
</style>
