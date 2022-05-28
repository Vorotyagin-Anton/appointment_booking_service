<template>
  <q-expansion-item
    class="profile-menu-item"
    :class="{'profile-menu-item_selected': isSelected}"
    :expand-icon-class="{'profile-menu-item__icon': !item.children}"
    :label="item.title"
    :default-opened="isSelected"
    @click="select"
  >
    <div v-if="item.children">
      <q-item
        class="profile-menu-item__child"
        v-for="child in item.children"
        :key="child.id"
        :to="child.to"
        clickable
        dense
      >
        <span class="profile-menu-item__link">{{ child.title }}</span>
      </q-item>
    </div>
  </q-expansion-item>
</template>

<script>
export default {
  name: "ProfileMenuItem",

  props: {
    item: {
      type: Object,
      required: true,
    },

    isSelected: {
      type: Boolean,
      default: false,
    },
  },

  emits: [
    'select',
  ],

  setup(props, {emit}) {
    const select = () => emit('select', props.item.id);

    return {
      select,
    }
  },
}
</script>

<style lang="scss">
.profile-menu-item {
  font-size: 14px;
  font-weight: 600;

  &_selected {
    color: $primary;
  }

  &__child {
    display: flex;
    align-items: center;
    padding-left: 30px;
  }

  &__link {
    font-size: 14px;
    font-weight: 500;
    color: $dark;
  }

  &__icon {
    display: none;
  }
}
</style>
