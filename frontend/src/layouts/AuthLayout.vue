<template>
  <q-layout class="auth-layout">
    <q-page-container class="auth-layout__container">

      <auth-header class="auth-layout__header"/>

      <router-view/>

      <auth-alert/>

    </q-page-container>

    <app-loading
      v-if="isRequested"
      title="Loading cabinet..."
    />
  </q-layout>
</template>

<script>
import useAuth from "src/hooks/auth/useAuth";
import AuthHeader from "components/Auth/AuthHeader";
import AuthAlert from "components/Auth/AuthAlert";
import AppLoading from "components/Common/AppLoading";

export default {
  name: "AuthLayout",

  components: {
    AuthHeader,
    AuthAlert,
    AppLoading,
  },

  setup() {
    const {isRequested} = useAuth();

    return {
      isRequested,
    }
  }
}
</script>

<style lang="scss">
.auth-layout {
  &__header {
    margin-bottom: 50px;
  }
}
</style>
