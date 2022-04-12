<template>
  <q-page-sticky
    expand position="top"
    class="container main-nav"
  >
    <q-toolbar class="main-nav__row">
      <q-tabs class="main-nav__tabs" align="left">

        <q-route-tab
          class="main-nav__tab"
          v-for="page in menu"
          :key="page.name"
          :label="page.label"
          :to="page.path"
        />

        <router-link :to="{name: 'signup'}">
          <q-btn class="main-nav__btn" color="primary" label="Sign up free" />
        </router-link>

        <q-btn class="main-nav__btn" outline color="primary" label="Connect with us" />
      </q-tabs>
    </q-toolbar>
  </q-page-sticky>
</template>

<script>
import { defineComponent } from 'vue';

const menu = [
  {
    name: 'overview',
    label: 'overview',
    path: '/',
  },
  {
    name: 'features',
    label: 'features',
    path: '/features',
  },
  {
    name: 'pricing',
    label: 'pricing',
    path: '/pricing',
  },
  {
    name: 'faq',
    label: 'FAQ',
    path: {path: '/', hash: '#faq'},
  },
];

export default defineComponent({
  name: 'MainNav',

  setup() {
    return {
      menu,
    }
  }
})
</script>

<style lang="scss">
  .main-nav {
    height: 50px;
    background-color: $white;
    border-top: .5px solid $grey;
    border-bottom: .5px solid $grey;

    &__row {
      display: flex;
      justify-content: flex-end;
    }

    &__tab {
      text-transform: capitalize;
    }

    &__btn {
      margin-left: 5px;
    }
  }
</style>
