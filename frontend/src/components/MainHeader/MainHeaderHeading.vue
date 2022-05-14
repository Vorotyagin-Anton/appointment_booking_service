<template>
  <q-toolbar-title class="main-heading">
    <router-link
      class="main-heading__link"
      :to="{name: 'main'}"
    >
      Booking Service
    </router-link>
  </q-toolbar-title>
</template>

<script>
export default {
  name: "MainHeaderHeading",
}
</script>

<style lang="scss">
.main-heading {
  display: flex;
  align-items: center;

  &__link {
    color: $black;
    font-size: 26px;
  }
}
</style>
