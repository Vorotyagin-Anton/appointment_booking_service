<template>
  <header class="container auth-header">
    <div class="auth-header__container">
      <router-link
        class="auth-header__logo"
        :to="{name: 'main'}"
      >
        <q-toolbar-title class="auth-header__heading">Booking Service</q-toolbar-title>
      </router-link>

      <router-link
        class="auth-header__link"
        :to="{name: 'main'}"
      >
        Learn more
      </router-link>
    </div>
  </header>
</template>

<script>
export default {
  name: "AuthHeader",
}
</script>

<style lang="scss">
.auth-header {

  &__container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 80px;
    padding: 0 25px;
  }

  &__heading {
    color: $dark;
  }

  &__link {
    font-size: 12px;
    font-weight: 500;
    letter-spacing: .5px;
    color: $blue-8;

    &:hover {
      color: $blue-6;
    }
  }
}
</style>
