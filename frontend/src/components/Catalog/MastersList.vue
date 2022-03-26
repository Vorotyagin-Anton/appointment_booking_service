<template>
  <div class="app-masters">
    <div class="app-masters__items" v-if="isMastersLoaded">
      <masters-list-item
        v-for="item in mastersList"
        :item="item"
        :key="item.id"
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
import MastersListItem from "components/Catalog/MastersListItem";
import useMastersList from "../../hooks/useMastersList";

export default {
  name: "MastersList",

  components: {
    MastersListItem,
  },

  setup() {
    const {mastersList, isMastersLoaded} = useMastersList();

    return {
      mastersList,
      isMastersLoaded,
    }
  }
}
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
