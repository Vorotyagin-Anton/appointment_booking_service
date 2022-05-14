<template>
  <div class="container cabinet-page">

    <div class="cabinet-page__center">
      <h1 class="cabinet-page__heading">Welcome to Booking Service. Here’s your business at a glance.</h1>

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

export default {
  name: "ProfilePage",

  components: {
    SetupBanner,
    CabinetActions,
    CabinetStats
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
    font-size: 22px;
    font-weight: 500;
  }
}
</style>
