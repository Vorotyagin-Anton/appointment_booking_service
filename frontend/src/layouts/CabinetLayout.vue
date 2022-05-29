<template>
  <q-layout view="hHh LpR fFf" class="cabinet-layout">
    <cabinet-header
      :left-drawer="leftDrawer"
      :right-drawer="rightDrawer"
      @toggle-left-drawer="toggleLeftDrawer"
      @toggle-right-drawer="toggleRightDrawer"
    />

    <div class="container">
      <q-drawer
        class="cabinet__left-drawer"
        v-model="leftDrawer.isOpen"
        :overlay="leftDrawer.isOverlay"
        :width="350"
        side="left"
        bordered
      >
        <cabinet-left-drawer/>
      </q-drawer>

      <q-drawer
        class="cabinet__right-drawer"
        v-model="rightDrawer.isOpen"
        :overlay="rightDrawer.isOverlay"
        :width="450"
        side="right"
        elevated
      >
        <!-- drawer content -->
      </q-drawer>
    </div>

    <q-page-container>
      <router-view
        @toggle-left-drawer="toggleLeftDrawer"
      />
    </q-page-container>

  </q-layout>
</template>

<script>
import {onMounted, ref} from 'vue'
import CabinetHeader from "components/Cabinet/CabinetHeader";
import CabinetLeftDrawer from "components/Cabinet/CabinetLeftDrawer";

export default {
  name: "CabinetLayout",

  components: {
    CabinetLeftDrawer,
    CabinetHeader,
  },

  setup() {
    const leftDrawer = ref({
      isOpen: true,
      isOverlay: false,
    });

    const rightDrawer = ref({
      isOpen: false,
      isOverlay: false,
    });

    const toggleLeftDrawer = (value) => {
      leftDrawer.value.isOpen = value.isOpen;
      leftDrawer.value.isOverlay = value.isOverlay;
    };

    const toggleRightDrawer = (value) => {
      rightDrawer.value.isOpen = value.isOpen;
      rightDrawer.value.isOverlay = value.isOverlay;
    };

    return {
      leftDrawer,
      rightDrawer,
      toggleLeftDrawer,
      toggleRightDrawer,
    }
  }
}
</script>

<style lang="scss">
.cabinet-layout {}
</style>
