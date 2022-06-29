<template>
  <q-page-sticky
    expand position="top"
    class="container main-nav"
  >
    <q-toolbar class="main-nav__row">
      <q-tabs
        class="main-nav__tabs"
        align="left"
        indicator-color="transparent"
      >
        <main-nav-tab
          v-for="tab in tabs"
          :key="tab.name"
          :name="tab.name"
          :title="tab.title"
          :to="tab.to"
          :child="tab.child"
          :selectable="tab.selectable"
          :isSelected="isTabSelected(tab.name)"
          @select="selectTab"
        />

        <div v-if="!isAuthorized">
          <router-link :to="{name: 'auth.signup'}">
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
        </div>
      </q-tabs>
    </q-toolbar>
  </q-page-sticky>
</template>

<script>
import {onMounted, ref, watch} from "vue";
import {useRoute} from "vue-router";
import MainNavTab from "components/MainNav/MainNavTab";
import DropdownCatalog from "components/MainNav/DropdownCatalog";
import DropdownFeatures from "components/MainNav/DropdownFeatures";
import useAuth from "src/hooks/user/useAuth";

const tabs = [
  {
    name: 'overview',
    title: 'Overview',
    routes: ['main'],
    to: {name: 'main'},
  },
  {
    name: 'catalog',
    title: 'Catalog',
    routes: ['masters'],
    selectable: false,
    child: DropdownCatalog,
  },
  {
    name: 'features',
    title: 'Features',
    selectable: false,
    child: DropdownFeatures,
  },
  {
    name: 'pricing',
    title: 'Pricing',
  },
  {
    name: 'faq',
    title: 'FAQ',
    to: {path: '/', hash: '#faq'},
  }
];

export default {
  name: 'MainNav',

  components: {
    MainNavTab,
  },

  setup() {
    const {isAuthorized} = useAuth();

    const route = useRoute();

    const selectedTab = ref('overview');

    const selectTab = (name) => selectedTab.value = name;

    const isTabSelected = (name) => selectedTab.value === name;

    const selectTabByRoute = (route) => {
      const tab = tabs.find(tab => {
        if (!tab.routes) {
          return false;
        }

        return tab.routes.includes(route.name);
      });

      if (route.hash === '#' + selectedTab.value) {
        return;
      }

      if (tab) {
        selectedTab.value = tab.name;
      }
    }

    watch(route, () => {
      selectTabByRoute(route);
    });

    onMounted(() => {
      selectTabByRoute(route);
    });

    return {
      isAuthorized,
      tabs,
      selectedTab,
      selectTab,
      isTabSelected,
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
