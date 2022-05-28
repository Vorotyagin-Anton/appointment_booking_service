<template>
  <div class="container cabinet-page">

    <div class="cabinet-page__center">
      <div class="cabinet-page__heading">Welcome to Booking Service. Here’s your business at a glance.</div>

      <setup-banner class="cabinet-page__banner"/>
    </div>

    <div class="cabinet-page__side">
      <cabinet-actions/>
      <cabinet-stats/>
    </div>
  </div>
</template>

<script>
import SetupBanner from "components/Cabinet/Banners/SetupBanner";
import CabinetActions from "components/Cabinet/CabinetActions";
import CabinetStats from "components/Cabinet/CabinetStats";
import {onMounted} from "vue";

export default {
  name: "DashboardPage",

  components: {
    SetupBanner,
    CabinetActions,
    CabinetStats,
  },

  emits: [
    'toggleLeftDrawer',
  ],

  setup(props, {emit}) {
    onMounted(() => {
      emit('toggleLeftDrawer', {
        isOpen: true,
        isOverlay: false,
      });
    });
  },
}
</script>

<style lang="scss">
.cabinet-page {
  display: flex;

  &__center {
    width: 740px;
    padding: 25px 50px;
  }

  &__side {
    width: 330px;
  }

  &__heading {
    padding: 25px 0 50px;
    font-size: 22px;
    font-weight: 500;
  }
}
</style>
