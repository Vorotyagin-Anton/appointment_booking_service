<template>
  <div class="main-link">
    <main-nav-link-dropdown
      v-if="link.children || link.groups"
      :link="link"
    />

    <q-route-tab
      v-else
      class="main-link__tab"
      :label="link.label ?? link.title"
      :to="{name: link.route}"
      no-caps
    />
  </div>
</template>

<script>
import MainNavLinkDropdown from "components/MainNav/MainLinkDropdown";

export default {
  name: "MainNavLink",

  components: {
    MainNavLinkDropdown,
  },

  props: {
    link: {
      type: Object,
      required: true,
    },
  },
}
</script>
