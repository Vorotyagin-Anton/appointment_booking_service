<script setup>
const props = defineProps({
  content: {
    type: String,
    required: true,
  },
});
</script>

<template>
  <div class="services-row-placeholder">
    {{ content }}
  </div>
</template>

<style lang="scss">
.services-row-placeholder {
  height: 100%;
  width: 100%;
  font-size: 18px;
  font-weight: 700;
  color: $grey-5;
  transition: color .4s;
}
</style>
