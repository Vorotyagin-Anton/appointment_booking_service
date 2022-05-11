<template>
  <q-page-sticky
    expand position="top"
    class="container main-nav"
  >
    <q-toolbar class="main-nav__row">
      <q-tabs
        class="main-nav__tabs"
        align="left"
        v-model="tab"
      >
        <main-link
          title="Overview"
          :to="{name: 'main'}"
        />

        <main-link title="Catalog">
          <dropdown-catalog/>
        </main-link>

        <main-link title="Features">
          <dropdown-features/>
        </main-link>

        <main-link
          title="Pricing"
          :to="{name: 'main'}"
        />

        <main-link
          title="FAQ"
          :to="{path: '/', hash: '#faq'}"
        />

        <router-link :to="{name: 'signup'}">
          <q-btn
            class="main-nav__btn"
            color="primary"
            label="Sign up free"
          />
        </router-link>

        <q-btn
          class="main-nav__btn"
          color="primary"
          label="Connect with us"
          outline
        />
      </q-tabs>
    </q-toolbar>
  </q-page-sticky>
</template>

<script>
import {ref} from "vue";
import MainLink from "components/MainNav/MainLink";
import DropdownFeatures from "components/MainNav/DropdownFeatures";
import DropdownCatalog from "components/MainNav/DropdownCatalog";

export default {
  name: 'MainNav',

  components: {
    MainLink,
    DropdownFeatures,
    DropdownCatalog,
  },

  setup() {
    const tab = ref('Overview');

    return {
      tab,
    }
  },
}
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

  &__btn {
    margin-left: 5px;
  }
}
</style>
