<template>
  <div class="order-master-card">

    <master-profile
      v-if="master"
      :master="master"
    />

    <div
      v-else
      class="order-master-card__loading"
    >
      <q-circular-progress
        reverse
        indeterminate
        size="50px"
        color="light-blue"
        class="q-ma-md"
      />
    </div>

  </div>
</template>

<script>
import useMaster from "src/hooks/useMaster";
import MasterProfile from "components/Master/MasterProfile";
import {useStore} from "vuex";
import {computed} from "vue";

export default {
  name: "OrderStepperMaster",

  components: {
    MasterProfile,
  },

  setup() {
    const {master, mountMaster} = useMaster();

    mountMaster();

    return {
      master,
    }
  }
}
</script>

<style lang="scss">
.order-master-card {
  &__loading {
    padding: 100px 0;
    display: flex;
    justify-content: center;
    align-items: center;
  }
}
</style>
