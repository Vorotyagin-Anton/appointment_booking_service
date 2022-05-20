<template>
  <q-menu
    class="cabinet-header-menu"
    anchor="bottom right"
    self="top right"
  >
    <q-list>
      <q-item class="cabinet-header-menu__item" dense>
        <q-item-section>
          <p class="cabinet-header-menu__user">{{ userName }}</p>
          <p class="cabinet-header-menu__tole">Owner</p>
        </q-item-section>
      </q-item>

      <q-item class="cabinet-header-menu__item" clickable v-close-popup dense>
        <q-item-section>
          <router-link
            class="cabinet-header-menu__link"
            :to="{name: 'cabinet'}"
          >
            Account settings
          </router-link>
        </q-item-section>
      </q-item>

      <q-separator class="cabinet-header-menu__separator"/>

      <q-item class="cabinet-header-menu__item" clickable v-close-popup dense>
        <q-item-section>
          <router-link
            class="cabinet-header-menu__link"
            :to="{name: 'cabinet'}"
          >
            Seller community
          </router-link>
        </q-item-section>
      </q-item>

      <q-item class="cabinet-header-menu__item" clickable v-close-popup dense>
        <q-item-section>
          <router-link
            class="cabinet-header-menu__link"
            :to="{name: 'cabinet'}"
          >
            Get a free processing
          </router-link>
        </q-item-section>
      </q-item>

      <q-item class="cabinet-header-menu__item" clickable v-close-popup dense>
        <q-item-section>
          <router-link
            class="cabinet-header-menu__link"
            :to="{name: 'cabinet'}"
          >
            Order a reader
          </router-link>
        </q-item-section>
      </q-item>

      <q-separator class="cabinet-header-menu__separator"/>

      <q-item class="cabinet-header-menu__item" clickable v-close-popup dense>
        <q-item-section>
          <router-link
            class="cabinet-header-menu__link"
            :to="{name: 'cabinet'}"
          >
            To tour dashboard
          </router-link>
        </q-item-section>
      </q-item>

      <q-item class="cabinet-header-menu__item" clickable v-close-popup dense>
        <q-item-section
          class="cabinet-header-menu__link"
          @click="logout"
        >
          Sign Out
        </q-item-section>
      </q-item>
    </q-list>
  </q-menu>
</template>

<script>
import useAuth from "src/hooks/auth/useAuth";
import {computed} from "vue";

export default {
  name: "CabinetHeaderMenu",

  setup() {
    const {user, logout} = useAuth();

    const userName = computed(() => {
      if (!user.value) {
        return null;
      }

      if (!user.value.name || !user.value.surname) {
        return user.value.email;
      }

      return user.value.name + ' ' + user.value.surname;
    });

    return {
      userName,
      logout,
    }
  }
}
</script>

<style lang="scss">
.cabinet-header-menu {
  min-width: 250px;
  padding: 25px 0 15px;

  &__item {
    .q-focus-helper {
      background: $primary !important;
    }
  }

  &__user {
    color: $black;
    font-weight: 600;
    margin: 0 0 5px;
  }

  &__link {
    color: $primary;
  }

  &__separator {
    margin: 10px 0;
  }
}
</style>
