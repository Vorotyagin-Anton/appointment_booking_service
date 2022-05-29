<template>
  <q-list class="cabinet-products">
    <q-item class="cabinet-products__item">
      <q-item-section class="cabinet-products__title">All products</q-item-section>
    </q-item>

    <q-item class="cabinet-products__item" clickable v-ripple>
      <q-item-section class="cabinet-products__text">Customers</q-item-section>

      <q-item-section side>
        <q-icon name="navigate_next"/>
      </q-item-section>
    </q-item>

    <q-item class="cabinet-products__item" clickable v-ripple>
      <q-item-section class="cabinet-products__text">Items & orders</q-item-section>

      <q-item-section side>
        <q-icon name="navigate_next"/>
      </q-item-section>
    </q-item>

    <q-item class="cabinet-products__item" clickable v-ripple>
      <q-item-section class="cabinet-products__text">Ecommerce</q-item-section>

      <q-item-section side>
        <q-icon name="navigate_next"/>
      </q-item-section>
    </q-item>

    <q-item class="cabinet-products__item" clickable v-ripple>
      <q-item-section class="cabinet-products__text">Payments</q-item-section>

      <q-item-section side>
        <q-icon name="navigate_next"/>
      </q-item-section>
    </q-item>

    <q-item class="cabinet-products__item" clickable v-ripple>
      <q-item-section class="cabinet-products__text">Reporting</q-item-section>

      <q-item-section side>
        <q-icon name="navigate_next"/>
      </q-item-section>
    </q-item>

    <q-item class="cabinet-products__item" clickable v-ripple>
      <q-item-section class="cabinet-products__text">Banking</q-item-section>

      <q-item-section side>
        <q-icon name="navigate_next"/>
      </q-item-section>
    </q-item>

    <q-item class="cabinet-products__item" clickable v-ripple>
      <q-item-section class="cabinet-products__text">Staff</q-item-section>

      <q-item-section side>
        <q-icon name="navigate_next"/>
      </q-item-section>
    </q-item>

    <q-item class="cabinet-products__item" clickable v-ripple>
      <q-item-section class="cabinet-products__text">POS system</q-item-section>

      <q-item-section side>
        <q-icon name="navigate_next"/>
      </q-item-section>
    </q-item>

    <q-item class="cabinet-products__item" clickable v-ripple>
      <q-item-section class="cabinet-products__text">Settings</q-item-section>

      <q-item-section side>
        <q-icon name="navigate_next"/>
      </q-item-section>
    </q-item>
  </q-list>
</template>

<script>
export default {
  name: "CabinetProducts",
}
</script>

<style lang="scss">
.cabinet-products {
  padding: 10px 15px;

  &__item {
    border-radius: 7px;

    .q-focus-helper {
      background: $primary !important;
    }
  }

  &__text {
    font-size: 16px;
    font-weight: 500;
    color: $black;
  }
}
</style>
