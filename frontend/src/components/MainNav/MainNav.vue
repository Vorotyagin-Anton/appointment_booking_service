<template>
  <q-page-sticky
    expand position="top"
    class="container main-nav"
  >
    <q-toolbar class="main-nav__row">
      <q-tabs class="main-nav__tabs" align="left">

        <main-link
          v-for="link in menu.links"
          :key="link.title"
          :link="link"
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
import useNavigation from "src/hooks/common/useNavigation";
import MainLink from "components/MainNav/MainLink";

export default {
  name: 'MainNav',

  components: {
    MainLink,
  },

  setup() {
    const {getGroup} = useNavigation();

    const menu = getGroup('Menu');

    return {
      menu,
    }
  }
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
