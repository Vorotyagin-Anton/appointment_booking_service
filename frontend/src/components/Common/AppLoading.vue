<template>
  <div class="app-loading">
    <div class="app-loading__content">
      <q-spinner
        class="app-loading__spinner"
        size="6em"
        :thickness="1"
      />
      <div class="app-loading__title">{{ title }}</div>
    </div>
  </div>
</template>

<script>
export default {
  name: "AppLoading",

  props: {
    title: {
      type: String,
      required: true,
    },
  },
}
</script>

<style lang="scss">
.app-loading {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  height: 100%;
  background-color: $white;
  z-index: 10000;

  &__content {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
  }

  &__spinner {
    color: $grey-7;
  }

  &__title {
    margin-top: 15px;
    font-size: 16px;
    font-weight: 300;
    color: $grey-8;
  }
}
</style>
