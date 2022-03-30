<template>
  <div class="app-masters">
    <div class="app-masters__items" v-if="!loading">
      <masters-list-item
        v-for="master in masters"
        :item="master"
        :key="master.id"
      />
    </div>
    <div v-else class="app-masters__loading">
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
import {defineComponent} from "vue";
import MastersListItem from "components/Catalog/MastersListItem";
import useMastersList from "src/hooks/useMastersList";

export default defineComponent({
  name: "MastersList",

  components: {
    MastersListItem,
  },

  setup() {
    const {loading, masters} = useMastersList();

    return {
      masters,
      loading,
    }
  }
})
</script>

<style lang="scss">
.app-masters {
  height: 100%;
  padding: 25px 50px;

  &__items {
    display: flex;
    justify-content: flex-start;
    flex-wrap: wrap;
  }

  &__loading {
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
  }
}
</style>
