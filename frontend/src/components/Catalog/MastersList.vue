<template>
  <div class="masters-list">
    <div class="masters-list__content" v-if="!loading">
      <div class="masters-list__items">
        <master-card
          v-for="item in items"
          :key="item.id"
          :master="item"
          @selected="selectMaster(item.id)"
        />
      </div>

      <div
        v-if="pages > 1"
        class="masters-list__pagination"
      >
        <q-pagination
          boundary-numbers
          v-model="page"
          :max="pages"
          :max-pages="8"
        />
      </div>
    </div>

    <div v-else class="masters-list__loading">
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
import {onMounted, toRef, watch} from "vue";
import useOrderModal from "src/hooks/order/useOrderModal";
import useList from "src/hooks/masters/useList";
import useLoading from "src/hooks/masters/useLoading";
import MasterCard from "components/Master/MasterCard";

export default {
  name: "MastersList",

  components: {
    MasterCard,
  },

  props: {
    params: {
      type: Object,
    }
  },

  setup(props) {
    const {loading} = useLoading();

    const params = toRef(props, 'params');

    const {items, pages, page, switchPage, getFromApi, flushItems} = useList();

    const {openOrderModal} = useOrderModal();

    onMounted(() => getFromApi(params.value));

    watch(params, async () => {
      await flushItems();
      await getFromApi(params.value);
    })

    watch(page, async () => {
      if (items.value.length === 0) {
        await getFromApi(params.value);
      }
    });

    const selectMaster = (id) => {
      openOrderModal();
    };

    return {
      loading,
      items,
      pages,
      page,
      selectMaster,
      switchPage,
    }
  }
}
</script>

<style lang="scss">
.masters-list {

  &__content {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  &__items {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
  }

  &__pagination {
    width: 100%;
    margin-top: 50px;
    display: flex;
    justify-content: center;
  }

  &__loading {
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
  }
}
</style>
