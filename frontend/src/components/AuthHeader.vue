<template>
  <header class="auth-header">
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
  </header>
</template>

<script>
export default {
  name: "AuthHeader",
}
</script>

<style lang="scss">
  .auth-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 60px;
    padding: 0 15px;

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
