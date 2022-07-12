<template>
  <q-header reveal class="container main-header">
    <div class="main-header__row">
      <q-toolbar class="main-header__col">
        <main-header-heading/>
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
                  <router-link
                    class="main-header__link"
                    :to="{name: 'cabinet'}"
                  >
                    Cabinet
                  </router-link>
                </q-item-section>
              </q-item>

              <q-item clickable v-close-popup dense>
                <q-item-section>
                  <router-link
                    class="main-header__link"
                    to="/"
                  >
                    Support
                  </router-link>
                </q-item-section>
              </q-item>

              <q-item clickable v-close-popup dense>
                <q-item-section
                  class="main-header__link"
                  @click="logout"
                >
                  Sign Out
                </q-item-section>
              </q-item>
            </q-list>
          </q-menu>
        </q-btn>

        <q-btn v-else flat>
          <router-link
            class="main-header__btn main-header__signin"
            :to="{name: 'auth.signin'}"
          >
            Sign In
          </router-link>
        </q-btn>
      </div>
    </div>
  </q-header>
</template>

<script>
import useAuth from "src/hooks/user/useAuth";
import useLogout from "src/hooks/user/useLogout";
import MainHeaderHeading from "components/MainHeader/MainHeaderHeading";

export default {
  name: "MainHeader",

  components: {
    MainHeaderHeading,
  },

  setup() {
    const {isAuthorized} = useAuth();
    const logout = useLogout();

    return {
      isAuthorized,
      logout,
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
    min-width: 200px;
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
