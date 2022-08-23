<script setup>
import ServiceCard from "components/Service/ServiceCard";
import {ref} from "vue";
import {useRouter} from "vue-router";

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

const router = useRouter();

const currentPage = ref(props.page);

const changePage = () => emit('changePage', currentPage.value);

const redirectToMaster = (serviceId) => {
  router.push({name: "masters", query: {services: [serviceId]}});
}

const handleSelect = (service) => {
  console.log(service);
  redirectToMaster(service.id);
};
</script>

<template>
  <div class="service-list">
    <div class="service-list__items">
      <service-card
        class="service-list__item"
        v-for="itemId in itemsIds"
        :key="itemId"
        :service="items[itemId]"
        @click="handleSelect"
      />
    </div>

    <div
      v-if="pages > 1"
      class="service-list__pagination"
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
.service-list {
  display: flex;
  flex-direction: column;
  padding: 0 10px;

  &__items {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
  }

  &__item {
    margin: 10px 5px;
    cursor: pointer;
  }

  &__pagination {
    width: 100%;
    margin-top: 50px;
    display: flex;
    justify-content: center;
  }
}
</style>
