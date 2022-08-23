<template>
  <div
    class="profile-type-item"
    :class="{'profile-type-item_selected': isSelected}"
    @click="selectItem"
  >
    <span class="material-icons profile-type-item__icon">{{ type.icon }}</span>

    <div class="profile-type-item__description">
      <span class="profile-type-item__title">{{ type.title }}</span>
      <span class="profile-type-item__promo">{{ type.promo }}</span>
    </div>
  </div>
</template>

<script>
export default {
  name: "ProfileTypeItem",

  props: {
    type: {
      type: Object,
      required: true,
    },

    isSelected: {
      type: Boolean,
      default: false,
    },
  },

  emits: [
    'selected',
  ],

  setup(props, { emit }) {
    const selectItem = () => emit('selected', props.type.id);

    return {
      selectItem,
    }
  },
}
</script>

<style lang="scss">
.profile-type-item {
  margin: 5px 0;
  width: 100%;
  height: 95px;
  display: flex;
  align-items: center;
  border: 1px solid $grey-5;
  border-radius: 3px;
  cursor: pointer;
  transition: all .3s;

  &:hover {
    box-shadow: rgba(0, 0, 0, .1) 0 4px 12px;
  }

  &_selected {
    background-color: $blue-1;
    color: $primary;
    border: 1px solid $primary;
    box-shadow: rgba(0, 0, 0, .1) 0 4px 12px;
  }

  &__title {
    font-size: 16px;
    line-height: 16px;
    font-weight: 400;
    margin-bottom: 10px;
  }

  &__promo {
    font-size: 14px;
    line-height: 14px;
    font-weight: 200;
  }

  &__description {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  &__icon {
    margin: 0 35px;
    font-size: 46px;
    font-weight: 100;
    color: $black !important;
  }
}
</style>
