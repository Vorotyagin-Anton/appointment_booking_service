<template>
  <q-layout view="hHh lpR fFf">
    <q-page-container>
      <auth-header/>

      <router-view/>

    </q-page-container>
  </q-layout>
</template>

<script>
import AuthHeader from "components/AuthHeader";

export default {
  name: "AuthLayout",

  components: {
    AuthHeader,
  }
}
</script>

<style lang="scss">

</style>
