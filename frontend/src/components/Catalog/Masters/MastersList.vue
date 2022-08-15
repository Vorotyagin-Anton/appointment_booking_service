<script setup>
import MasterCard from "components/Master/MasterCard";
import useMaster from "src/hooks/useMaster";
import {ref} from "vue";

const props = defineProps({
  items: {
    type: Object,
    required: true,
  },

  itemsIds: {
    type: Array,
    required: true,
  },

  page: Number,
  pages: Number,
});

const emit = defineEmits(['changePage']);

const {selectMaster, reserveMaster} = useMaster();

const currentPage = ref(props.page);

const changePage = () => emit('changePage', currentPage.value)
</script>

<template>
  <div class="masters-list">
    <div class="masters-list__items">
      <master-card
        class="masters-list__item"
        v-for="itemId in itemsIds"
        :key="itemId"
        :master="items[itemId]"
        @selected="selectMaster"
        @reserved="reserveMaster"
      />
    </div>

    <div
      v-if="pages > 1"
      class="masters-list__pagination"
    >
      <q-pagination
        boundary-numbers
        :max="pages"
        :max-pages="8"
        v-model="currentPage"
        @update:model-value="changePage"
      />
    </div>
  </div>
</template>

<style lang="scss">
.masters-list {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 0 10px;

  &__items {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
  }

  &__item {
    margin: 10px 5px;
  }

  &__pagination {
    width: 100%;
    margin-top: 50px;
    display: flex;
    justify-content: center;
  }
}
</style>
