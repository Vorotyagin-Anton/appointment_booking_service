<template>
  <q-layout view="hHh lpR fFf">

    <MainHeader/>

    <q-page-container>
      <div class="main">
        <router-view/>
      </div>
      <main-nav/>
      <order-modal/>
    </q-page-container>

    <MainFooter/>

  </q-layout>
</template>

<script>
import MainHeader from "components/MainHeader";
import MainFooter from "components/MainFooter/MainFooter";
import MainNav from "components/MainNav/MainNav";
import OrderModal from "components/Order/OrderModal";

export default {
  name: 'MainLayout',

  components: {
    MainFooter,
    MainHeader,
    MainNav,
    OrderModal,
  },
}
</script>

<style lang="scss">
  .main {
    padding-top: 50px;
  }
</style>
