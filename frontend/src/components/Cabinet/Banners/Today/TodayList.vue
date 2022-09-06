<script setup>
import {useStore} from "vuex";
import {computed} from "vue";
import TodayListItem from "components/Cabinet/Banners/Today/TodayListItem";

const store = useStore();
const todayItems = computed(() => store.getters['appointments/getTodayItems']);
</script>

<template>
  <today-list-item
    v-for="item in todayItems"
    :key="item.id"
    :item="item"
  />
</template>
