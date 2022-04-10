<template>
  <q-layout class="auth-layout">
    <q-page-container class="auth-layout__container">

      <auth-header class="auth-layout__header"/>

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
.auth-layout {
  &__header {
    margin-bottom: 50px;
  }
}
</style>
