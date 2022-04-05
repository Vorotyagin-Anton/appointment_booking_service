<template>
  <q-layout view="hHh lpR fFf">

    <MainHeader/>

    <q-page-container>
      <div class="main">
        <router-view/>
      </div>
      <main-nav/>
    </q-page-container>

    <MainFooter/>

  </q-layout>
</template>

<script>
import {defineComponent} from 'vue'
import MainHeader from "components/MainHeader";
import MainFooter from "components/MainFooter";
import MainNav from "components/MainNav";

export default defineComponent({
  name: 'MainLayout',

  components: {
    MainFooter,
    MainHeader,
    MainNav,
  },
})
</script>

<style lang="scss">
  .main {
    padding-top: 50px;
  }
</style>
