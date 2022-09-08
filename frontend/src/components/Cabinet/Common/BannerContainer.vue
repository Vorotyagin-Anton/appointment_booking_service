<template>
  <q-banner class="banner-container">
    <slot/>
  </q-banner>
</template>

<style lang="scss">
.banner-container {
  padding: 25px;
  border-radius: 8px;
  box-shadow: 0 1px 2px rgb(0 0 0 / 10%), 0 0 4px rgb(0 0 0 / 10%);
}
</style>
