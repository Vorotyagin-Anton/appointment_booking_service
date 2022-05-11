<template>
  <q-menu
    class="dropdown-catalog"
    square
    :transition-duration="200"
  >
    <q-list
      class="dropdown-catalog__content"
      style="min-width: 200px"
      dense
    >
      <q-item clickable>
        <q-item-section class="dropdown-catalog__link">Categories</q-item-section>

        <q-item-section side>
          <q-icon name="keyboard_arrow_right"/>
        </q-item-section>

        <q-menu
          class="dropdown-catalog"
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
              <q-item-section class="dropdown-catalog__category">{{ category.name }}</q-item-section>
            </q-item>
          </q-list>
        </q-menu>

      </q-item>

      <q-separator/>

      <q-item v-close-popup clickable>
        <q-item-section>
          <router-link
            class="dropdown-catalog__link"
            :to="{name: 'main'}"
          >
            Services
          </router-link>
        </q-item-section>
      </q-item>

      <q-item v-close-popup clickable>
        <q-item-section>
          <router-link
            class="dropdown-catalog__link"
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
export default {
  name: "DropdownCatalog",

  setup() {
    const categories = [
      {id: 1, name: 'Hair salons'},
      {id: 2, name: 'Barbershops'},
      {id: 3, name: 'Spas and nail salons'},
      {id: 4, name: 'Personal training'},
      {id: 5, name: 'Health and wellness'},
      {id: 6, name: 'Personal services'},
      {id: 7, name: 'Home repair and cleaning'},
      {id: 8, name: 'Tutoring and music lessons'},
    ];

    return {
      categories,
    }
  }
}
</script>

<style lang="scss">
.dropdown-catalog {
  padding: 15px 0;
  border-top: 1px solid $grey-4;
  box-shadow: rgba(0, 0, 0, 0.1) 0 1px 3px 0, rgba(0, 0, 0, .06) 0 1px 2px 0;

  &__link {
    padding: 5px 0;
    color: $dark;
    font-size: 14px;
  }

  &__category {
    padding: 5px 10px;
  }
}
</style>
