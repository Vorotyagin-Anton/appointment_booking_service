<template>
  <q-card class="service-card">
    <q-img src="https://cdn.quasar.dev/img/parallax1.jpg">
      <div class="absolute-bottom text-h6">
        {{ name }}
      </div>
    </q-img>

    <q-card-section>{{ content }}</q-card-section>
  </q-card>
</template>

<script>
import {toRefs} from "vue";

export default {
  name: "MastersListItem",

  props: {
    item: {
      type: Object,
      required: true,
    },
  },

  setup(props) {
    const {item} = toRefs(props);

    return {
      title: item.value.name,
      content: item.value.content,
    }
  }
}
</script>

<style lang="scss">
.service-card {
  width: 100%;
  max-width: 280px;
  margin-bottom: 35px;
  margin-right: 35px;
  transition: 0.3s ease-in-out;

  &:hover {
    transform: scale(1.04);
    cursor: pointer;
  }
}
</style>
