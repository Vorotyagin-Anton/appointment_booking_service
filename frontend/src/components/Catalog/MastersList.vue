<template>
  <div class="app-masters">
    <div class="app-masters__list" v-if="!loading">
      <div class="app-masters__items">
        <masters-list-item
          v-for="item in items"
          :item="item"
          :key="item.id"
          @selected="selectMaster"
        />
      </div>

      <div class="q-pa-lg flex flex-center app-masters__pagination">
        <q-pagination
          v-model="page"
          :max="pages"
          :max-pages="8"
          boundary-numbers
        />
      </div>
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
import useMastersList from "src/hooks/useMastersList";
import useOrderModal from "src/hooks/order/useOrderModal";
import MastersListItem from "components/Catalog/MastersListItem";

export default {
  name: "MastersList",

  components: {
    MastersListItem,
  },

  setup() {
    const {loading, items, pages, page} = useMastersList();

    const {openOrderModal} = useOrderModal();

    const selectMaster = (master) => {
      console.log(master);
      openOrderModal();
    };

    return {
      loading,
      items,
      pages,
      page,
      selectMaster,
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
    justify-content: center;
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
