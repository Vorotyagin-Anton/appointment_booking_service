<template>
  <div class="login-page">
    <div class="login-page__content">

      <h2 class="login-page__heading">Sign in</h2>

      <login-form class="login-page__form"/>
    </div>
  </div>
</template>

<script>
import LoginForm from "components/Auth/LoginForm";

export default {
  name: "LoginPage",

  components: {
    LoginForm,
  }
}
</script>

<style lang="scss">
.login-page {
  display: flex;
  align-items: center;
  justify-content: center;

  &__content {
    padding-top: 300px;
  }

  &__heading {
    text-align: left;
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 20px;
  }
}
</style>
