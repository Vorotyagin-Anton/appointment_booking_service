<template>
  <header class="app-section-header">
    <h2 class="app-section-header__heading">
      {{ heading }}
    </h2>

    <p
      class="app-section-header__description"
      v-if="description"
    >
      {{ description }}
    </p>
  </header>
</template>

<script>
export default {
  name: "AppSectionHeader",

  props: {
    heading: {
      type: String,
      required: true,
    },

    description: {
      type: String,
    },
  },
}
</script>

<style lang="scss">
.app-section-header {
  display: flex;
  flex-direction: column;
  align-items: center;

  &__heading {
    font-size: 46px;
    font-weight: 400;
    letter-spacing: 1.5px;
  }

  &__description {
    font-size: 16px;
    font-weight: 300;
    line-height: 2;
  }
}
</style>
