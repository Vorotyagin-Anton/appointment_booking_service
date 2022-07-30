<script setup>

</script>

<template>
  <div class="service-row">
    <div class="service-row__col service-row__status">
      <slot name="status"/>
    </div>

    <div class="service-row__col service-row__name">
      <slot name="name"/>
    </div>

    <div class="service-row__col service-row__duration">
      <slot name="duration"/>
    </div>

    <div class="service-row__col service-row__price">
      <slot name="price"/>
    </div>

    <div class="service-row__col service-row__description">
      <slot name="description"/>
    </div>

    <div class="service-row__col service-row__image">
      <slot name="image"/>
    </div>

    <div class="service-row__col service-row__actions">
      <slot name="actions"/>
    </div>
  </div>
</template>

<style lang="scss">
.service-row {
  position: relative;
  display: flex;
  justify-content: space-between;
  border-bottom: 1px solid rgba(0, 0, 0, .12);

  &:first-of-type {
    width: 100%;
    height: 35px;
    display: flex;
    justify-content: space-between;
    border-bottom: 1px solid rgba(0, 0, 0, .12);
    background-color: $grey-3;
  }

  &:last-of-type {
    border-bottom: none;
  }

  &__col {
    padding: 5px 10px;
  }

  &__active {
    cursor: pointer;
  }

  &__name {
    flex: 3;
  }

  &__image {
    flex: 3;
  }

  &__description {
    flex: 4;
  }

  &__duration,
  &__price,
  &__actions {
    flex: 2;
  }

  &__checkbox {
    margin-right: 15px;

    .q-checkbox__inner {
      &:before {
        background: none;
      }
    }
  }
}
</style>
