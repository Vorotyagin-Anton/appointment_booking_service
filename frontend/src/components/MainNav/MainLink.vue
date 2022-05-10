<template>
  <div class="main-link">
    <q-route-tab
      class="main-link__tab"
      :label="label"
      :to="path"
    />
  </div>
</template>

<script>
import useLink from "src/hooks/common/useLink";

export default {
  name: "MainLink",

  props: {
    link: {
      type: Object,
      required: true,
    },
  },

  setup(props) {
    const {label, path} = useLink(props);

    return {
      label,
      path,
    }
  }
}
</script>

<style lang="scss">
.main-link {
  &__tab {
    text-transform: capitalize;
  }
}
</style>
