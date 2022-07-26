<script setup>
import {computed} from "vue";
import useAuth from "src/hooks/user/useAuth";
import useLogout from "src/hooks/user/useLogout";

const {user} = useAuth();
const logout = useLogout();

const userName = computed(() => {
  if (!user.value.name || !user.value.surname) {
    return user.value.email;
  }

  return user.value.name + ' ' + user.value.surname;
});
</script>

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
          <p class="cabinet-header-menu__role">Owner</p>
        </q-item-section>
      </q-item>

      <q-separator class="cabinet-header-menu__separator"/>

      <q-item class="cabinet-header-menu__item" clickable v-close-popup dense>
        <q-item-section>
          <router-link
            class="cabinet-header-menu__link"
            :to="{name: 'cabinet.business'}"
          >
            Business
          </router-link>
        </q-item-section>
      </q-item>

      <q-item class="cabinet-header-menu__item" clickable v-close-popup dense>
        <q-item-section>
          <router-link
            class="cabinet-header-menu__link"
            :to="{name: 'cabinet.profile'}"
          >
            Profile settings
          </router-link>
        </q-item-section>
      </q-item>

      <q-item class="cabinet-header-menu__item" clickable v-close-popup dense>
        <q-item-section>
          <router-link
            class="cabinet-header-menu__link"
            :to="{name: 'cabinet.schedule'}"
          >
            Change schedule
          </router-link>
        </q-item-section>
      </q-item>

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

      <q-separator class="cabinet-header-menu__separator"/>

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

  &__role {
    margin: 0;
  }

  &__link {
    color: $primary;
  }

  &__separator {
    margin: 10px 0;
  }
}
</style>
