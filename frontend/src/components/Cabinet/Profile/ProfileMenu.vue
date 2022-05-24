<template>
  <div class="profile-menu">
    <profile-menu-item
      class="profile-menu__item"
      v-for="item in menu"
      :key="item.id"
      :item="item"
      :is-selected="currentItem === item.id"
      @select="handleSelect"
    />
  </div>
</template>

<script>
import {ref} from "vue";
import ProfileMenuItem from "components/Cabinet/Profile/ProfileMenuItem";

export default {
  name: "ProfileMenu",

  components: {
    ProfileMenuItem,
  },

  props: {
    menu: {
      type: Array,
      required: true,
    },

    selectedItem: {
      type: Number,
      default: 1,
    },
  },

  emits: [
    'select',
  ],

  setup(props, {emit}) {
    const currentItem = ref(props.selectedItem);

    const handleSelect = (id) => {
      currentItem.value = id;
      emit('select', id);
    };

    return {
      currentItem,
      handleSelect,
    }
  },
}
</script>

<style lang="scss">
.profile-menu {
  min-width: 250px;
  padding-top: 35px;
}
</style>
