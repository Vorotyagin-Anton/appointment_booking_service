<template>
  <div class="main-link">
    <q-route-tab
      class="main-link__tab"
      :name="title"
      :label="title"
      :to="to"
    >
      <slot/>
    </q-route-tab>
  </div>
</template>

<script>
export default {
  name: "MainLink",

  props: {
    title: {
      type: String,
      required: true,
    },

    to: {
      type: Object,
      default: () => ({path: '#'})
    }
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
