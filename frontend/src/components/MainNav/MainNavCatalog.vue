<template>
  <q-menu
    class="main-nav-catalog"
    square
    :transition-duration="200"
  >
    <q-list
      class="main-nav-catalog__content"
      style="min-width: 200px"
      dense
    >
      <q-item clickable>
        <q-item-section class="main-nav-catalog__link">Categories</q-item-section>

        <q-item-section side>
          <q-icon name="keyboard_arrow_right"/>
        </q-item-section>

        <q-menu
          class="main-nav-catalog"
          anchor="top end"
          self="top left"
          square
        >
          <q-list>
            <q-item
              v-for="category in categories"
              :key="category.id"
              dense
              clickable
            >
              <q-item-section class="main-nav-catalog__link">{{ category.name }}</q-item-section>
            </q-item>
          </q-list>
        </q-menu>

      </q-item>

      <q-separator/>

      <q-item v-close-popup clickable>
        <q-item-section>
          <router-link
            class="main-nav-catalog__link"
            :to="{name: 'services'}"
          >
            Services
          </router-link>
        </q-item-section>
      </q-item>

      <q-item v-close-popup clickable>
        <q-item-section>
          <router-link
            class="main-nav-catalog__link"
            :to="{name: 'masters'}"
          >
            Masters
          </router-link>
        </q-item-section>
      </q-item>
    </q-list>
  </q-menu>
</template>

<script>
import useList from "src/hooks/categories/useList";

export default {
  name: "MainNavCatalog",

  setup() {
    const {categories} = useList();

    return {
      categories,
    }
  }
}
</script>

<style lang="scss">
.main-nav-catalog {
  min-width: 250px;
  padding: 25px 0 15px;

  &__link {
    min-width: 160px;
    padding: 5px 0;
    color: $dark;
    font-size: 15px;
    font-weight: 400;
    text-transform: capitalize;
  }
}
</style>
