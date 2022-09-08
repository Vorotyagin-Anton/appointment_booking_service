<template>
  <img :src="src" alt="alt">
</template>

<script>
export default {
  name: "AppImage",

  props: {
    src: {
      type: String,
      required: true,
    },

    alt: {
      type: String,
      default: 'img',
    },
  },
}
</script>
