<template>
  <div class="profile-intro">
    <div class="profile-intro__content">
      <app-image
        class="profile-intro__img"
        src="profile-information-intro.svg"
      />

      <div class="profile-intro__text">
        <h2 class="profile-intro__h2">Set up your profile</h2>
        <p class="profile-intro__p">We need to verify your identity to confirm you're a real person.</p>
        <p class="profile-intro__p">This will only three minutes.</p>
      </div>

      <div class="profile-intro__bottom">
        <q-btn
          class="profile-intro__btn"
          label="Continue"
          color="primary"
          no-caps
          @click="next"
        />
      </div>
    </div>
  </div>
</template>

<script>
import AppImage from "components/Common/AppImage";

export default {
  name: "ProfileIntro",

  components: {
    AppImage,
  },

  emits: [
    'next',
    'prev',
  ],

  setup(props, {emit}) {
    const next = () => emit('next');

    return {
      next,
    }
  }
}
</script>

<style lang="scss">
.profile-intro {
  display: flex;
  justify-content: center;

  &__content {
    width: 750px;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  &__img {
    width: 360px;
  }

  &__text {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
  }

  &__h2 {
    font-size: 36px;
    padding: 15px 0;
  }

  &__p {
    font-size: 18px;
    margin-bottom: 15px;
    font-weight: 200;
  }

  &__bottom {
    width: 100%;
    display: flex;
    justify-content: flex-end;
    padding: 25px 0;
    border-top: 1px solid $grey-4;
  }

  &__btn {
    width: 350px;
    height: 40px;
  }
}
</style>
