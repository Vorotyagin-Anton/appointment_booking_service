<template>
  <q-layout view="hHh LpR fFf" class="cabinet">

    <cabinet-header
      @toggleLeftDrawer="toggleLeftDrawer"
      @toggleRightDrawer="toggleRightDrawer"
    />

    <div class="container">
      <q-drawer
        class="cabinet__left-drawer"
        v-model="leftDrawerOpen"
        side="left"
        :width="350"
        show-if-above
        bordered
      >
        <cabinet-left-drawer/>
      </q-drawer>

      <q-drawer
        class="cabinet__right-drawer"
        v-model="rightDrawerOpen"
        side="right"
        :width="450"
        overlay
        elevated
      >
        <!-- drawer content -->
      </q-drawer>
    </div>

    <q-page-container>
      <router-view/>
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
    const leftDrawerOpen = ref(false)
    const rightDrawerOpen = ref(false)

    const toggleLeftDrawer = () => leftDrawerOpen.value = !leftDrawerOpen.value;
    const toggleRightDrawer = () => rightDrawerOpen.value = !rightDrawerOpen.value;

    return {
      leftDrawerOpen,
      rightDrawerOpen,
      toggleLeftDrawer,
      toggleRightDrawer,
    }
  }
}
</script>

<style lang="scss">
</style>
