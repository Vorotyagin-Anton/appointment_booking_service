<template>
  <router-link :to="path">
    {{ label }}
  </router-link>
</template>

<script>
import useLink from "src/hooks/common/useLink";

export default {
  name: "CommonLink",

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
