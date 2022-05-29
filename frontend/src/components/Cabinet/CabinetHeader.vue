<template>
  <q-header reveal bordered class="cabinet-header cabinet__header">
    <q-toolbar>
      <q-btn
        class="cabinet-header__icon cabinet-header__icon_left"
        icon="menu"
        flat
        @click="toggleLeftDrawer"
      />

      <main-header-heading/>

      <q-btn
        class="cabinet-header__icon"
        flat
        icon="chat_bubble_outline"
        @click="toggleRightDrawer"
      />

      <q-btn
        class="cabinet-header__icon"
        flat
        icon="notifications_none"
        @click="toggleRightDrawer"
      />

      <q-btn
        class="cabinet-header__icon"
        flat
        icon="help_outline"
        @click="toggleRightDrawer"
      />

      <q-btn
        class="cabinet-header__icon"
        flat
        icon="pending_actions"
        @click="toggleRightDrawer"
      />

      <q-btn
        class="cabinet-header__icon"
        label="My Business"
        flat
        no-caps
      >
        <cabinet-header-menu/>
      </q-btn>
    </q-toolbar>
  </q-header>
</template>

<script>
import MainHeaderHeading from "components/MainHeader/MainHeaderHeading";
import CabinetHeaderMenu from "components/Cabinet/CabinetHeaderMenu";
import {ref} from "vue";

export default {
  name: "CabinetHeader",

  components: {
    CabinetHeaderMenu,
    MainHeaderHeading,
  },

  props: {
    leftDrawer: {
      type: Object,
      required: true,
    },

    rightDrawer: {
      type: Object,
      required: true,
    },
  },

  emits: [
    'toggleLeftDrawer',
    'toggleRightDrawer',
  ],

  setup(props, {emit}) {
    const toggleLeftDrawer = () => {
      emit('toggleLeftDrawer', {
        isOpen: !props.leftDrawer.isOpen,
        isOverlay: props.leftDrawer.isOverlay,
      });
    };

    const toggleRightDrawer = () => {
      emit('toggleRightDrawer', {
        isOpen: !props.rightDrawer.isOpen,
        isOverlay: !props.rightDrawer.isOverlay,
      });
    };

    return {
      toggleLeftDrawer,
      toggleRightDrawer,
    }
  },
}
</script>

<style lang="scss">
.cabinet-header {
  background-color: $white;

  &__icon {
    color: $black;

    &_left {
      margin-right: 15px;
    }
  }
}
</style>
