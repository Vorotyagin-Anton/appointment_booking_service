<template>
  <q-breadcrumbs
    class="breadcrumbs-list"
    gutter="xs"
  >
    <q-breadcrumbs-el
      class="breadcrumbs-list__item"
      :class="{'breadcrumbs-list__item_active': isMainCrumb(crumb.title)}"
      v-for="crumb in breadcrumbs"
      :key="crumb.title"
      :label="crumb.title"
      :to="crumb.path"
    />
  </q-breadcrumbs>
</template>

<script>
import {toRef} from "vue";

export default {
  name: "BreadcrumbsList",

  props: {
    breadcrumbs: {
      type: Array,
      required: true,
    }
  },

  setup(props) {
    const items = toRef(props, 'breadcrumbs');
    
    const isMainCrumb = (title) => title === items.value[items.value.length - 1].title;

    return {
      items,
      isMainCrumb,
    }
  }
}
</script>

<style lang="scss">
.breadcrumbs-list {
  &__path {
    color: $grey-8;
  }

  &__item {
    height: 30px;
    font-size: 14px;
    font-weight: 300;
    text-transform: uppercase;

    &_active {
      color: $dark;
      font-weight: 600;
    }
  }
}
</style>
