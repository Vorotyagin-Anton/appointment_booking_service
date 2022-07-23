<template>
  <img :src="source" alt="alt">
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

  setup(props) {
    return {
      source: process.env.HOST + '/uploads/photo/' + props.src,
    }
  },
}
</script>
