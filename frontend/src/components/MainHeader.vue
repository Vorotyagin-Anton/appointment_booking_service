<template>
  <q-header reveal class="container main-header">
    <div class="main-header__row">
      <q-toolbar class="main-header__col">
        <q-toolbar-title class="main-header__title">Booking Service</q-toolbar-title>
      </q-toolbar>

      <div class="main-header__col main-header__menu">

      </div>

      <div class="main-header__col">
        <q-btn class="main-header__signin" flat label="Sign In" />
      </div>
    </div>
  </q-header>
</template>

<script>
import {defineComponent} from 'vue';

export default defineComponent({
  name: "MainHeader",
})
</script>

<style lang="scss">
.main-header {
  background-color: $white;
  color: $dark;
  height: 70px;

  &__row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 100%;
    padding: 0 15px;
  }

  &__heading {
    font-size: 24px;
  }

  &__title {
    display: flex;
    align-items: center;
  }

  &__icon {
    font-size: 24px;
    margin-right: 10px;
  }

  &__signin {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100px;
    height: 50px;
    text-transform: capitalize;
  }
}
</style>
