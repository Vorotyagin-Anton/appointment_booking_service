<template>
  <q-menu
    class="container link-dropdown"
    self="top middle"
    square
    :transition-duration="200"
  >
    <div class="link-dropdown__content">
      <div
        v-for="group in groups"
        :key="group.name"
        class="link-dropdown__group"
      >
        <h4 class="link-dropdown__title">
          {{ group.name }}
        </h4>

        <router-link
          class="link-dropdown__link"
          v-for="link in group.links"
          :key="link.title"
          :to="link.to"
        >
          {{ link.title }}
        </router-link>
      </div>
    </div>
  </q-menu>
</template>

<script>

import useNavigation from "src/hooks/common/useNavigation";

export default {
  name: "DropdownFeatures",

  setup() {
    const {getGroups} = useNavigation();

    const groups = getGroups([
      'Payments',
      'Point of Sale',
      'Hardware',
      'Tools',
      'Developers',
      'Resource',
      'Business Types',
      'Square',
    ]);

    return {
      groups,
    }
  }
}
</script>

<style lang="scss">
.link-dropdown {
  max-width: 100vw;
  box-shadow: rgba(0, 0, 0, .1) 0 1px 3px 0, rgba(0, 0, 0, .06) 0 1px 2px 0;
  border-top: 1px solid $grey-4;

  &__content {
    width: 100vw;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    padding: 15px 25px 0;
  }

  &__group {
    padding: 10px 15px 25px;
    display: flex;
    flex-direction: column;
  }

  &__title {
    color: $dark;
    font-weight: 500;
    font-size: 14px;
    margin-bottom: 5px;
  }

  &__link {
    color: $grey-8;
    font-weight: 400;
    font-size: 13px;
    padding-bottom: 3px;
    text-transform: capitalize;
    transition-property: color;
    transition-duration: .2s;

    &:hover {
      color: $dark;
    }
  }
}
</style>
