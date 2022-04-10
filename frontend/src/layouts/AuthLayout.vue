<template>
  <q-layout class="auth-page">
    <q-page-container class="auth-page__container">

      <auth-header class="auth-page__header"/>

      <router-view/>

      <auth-alert/>

    </q-page-container>
  </q-layout>
</template>

<script>
import AuthHeader from "components/Auth/AuthHeader";
import AuthAlert from "components/Auth/AuthAlert";

export default {
  name: "AuthLayout",

  components: {
    AuthHeader,
    AuthAlert
  },
}
</script>

<style lang="scss">
.auth-page {
  &__header {
    margin-bottom: 50px;
  }
}
</style>
