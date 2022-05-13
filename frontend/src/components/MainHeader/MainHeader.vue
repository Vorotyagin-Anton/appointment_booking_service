<template>
  <q-header reveal class="container main-header">
    <div class="main-header__row">
      <q-toolbar class="main-header__col">
        <router-link :to="{name: 'main'}">
          <q-toolbar-title class="main-header__title">
            Booking Service
          </q-toolbar-title>
        </router-link>
      </q-toolbar>

      <div class="main-header__col">
        <q-btn
          class="main-header__btn main-header__account"
          v-if="isAuthorized"
          label="My Account"
          flat
        >
          <q-menu
            class="main-header__dropdown"
            anchor="bottom right"
            self="top right"
          >
            <q-list style="min-width: 100px">
              <q-item clickable v-close-popup dense>
                <q-item-section>
                  <router-link class="main-header__link" :to="{name: 'profile'}">Profile</router-link>
                </q-item-section>
              </q-item>

              <q-item clickable v-close-popup dense>
                <q-item-section>
                  <router-link class="main-header__link" to="/">Dashboard</router-link>
                </q-item-section>
              </q-item>

              <q-item clickable v-close-popup dense>
                <q-item-section>
                  <router-link class="main-header__link" to="/">Support</router-link>
                </q-item-section>
              </q-item>

              <q-item clickable v-close-popup dense>
                <q-item-section>
                  <router-link class="main-header__link" to="/">Sign Out</router-link>
                </q-item-section>
              </q-item>
            </q-list>
          </q-menu>
        </q-btn>

        <q-btn v-else flat>
          <router-link
            class="main-header__btn main-header__signin"
            :to="{name: 'signin'}"
          >
            Sign In
          </router-link>
        </q-btn>
      </div>
    </div>
  </q-header>
</template>

<script>
import useAuth from "src/hooks/auth/useAuth";

export default {
  name: "MainHeader",

  setup() {
    const {isAuthorized} = useAuth();

    return {
      isAuthorized,
    }
  },
}
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
    color: $black;
    font-size: 26px;
  }

  &__icon {
    font-size: 24px;
    margin-right: 10px;
  }

  &__btn {
    display: flex;
    justify-content: center;
    align-items: center;
    text-transform: capitalize;
    color: $black;
    font-size: 16px;
    font-weight: 500;
  }

  &__signin {
    width: 80px;
    height: 40px;
  }

  &__account {
    width: 140px;
    height: 50px;
  }

  &__dropdown {
    width: 250px;
    padding: 15px 0;
  }

  &__link {
    padding: 5px 15px;
    color: $black;
    font-size: 15px;
    font-weight: 500;
  }
}
</style>
