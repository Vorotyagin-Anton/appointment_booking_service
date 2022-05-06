<template>
  <section class="container app-section">
    <slot/>
  </section>
</template>

<script>
export default {
  name: "AppSection",
}
</script>

<style lang="scss">
.app-section {
  padding-top: 50px;
  padding-bottom: 50px;
}
</style>
