<template>
  <q-expansion-item
    class="faq-item"
    header-class="faq-item__title"
    :label="item.label"
    expand-icon-toggle
    expand-separator
  >
    <q-card class="faq-item__card">
      <q-card-section class="faq-item__section">
        {{ item.content }}
      </q-card-section>
    </q-card>
  </q-expansion-item>
</template>

<script>
export default {
  name: "FaqSectionItem",

  props: {
    item: {
      type: Object,
      required: true,
    },
  },
}
</script>

<style lang="scss">
.faq-item {
  border-bottom: 1px solid $white100;
  padding: 25px 0;
  width: 100%;

  &:first-child {
    border-top: 1px solid $white100;
  }

  &__title {
    font-size: 15px;
    font-weight: 600;
  }

  &__card {
    background-color: $charcoal;
  }
}
</style>
