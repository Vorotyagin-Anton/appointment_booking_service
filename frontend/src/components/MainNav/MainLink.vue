<template>
  <div class="main-link">
    <main-link-dropdown
      v-if="link.children || link.groups"
      :link="link"
    />

    <q-route-tab
      v-else
      class="main-link__tab"
      :label="link.label ?? link.title"
      :to="{name: link.route}"
    />
  </div>
</template>

<script>
import MainLinkDropdown from "components/MainNav/MainLinkDropdown";

export default {
  name: "MainLink",

  components: {
    MainLinkDropdown,
  },

  props: {
    link: {
      type: Object,
      required: true,
    },
  },
}
</script>

<style lang="scss">
.main-link {
  &__tab {
    text-transform: capitalize;
  }
}
</style>
