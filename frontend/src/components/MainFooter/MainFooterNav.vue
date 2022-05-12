<template>
  <div class="main-footer-nav">

    <div
      class="main-footer-nav__group"
      v-for="group in groups"
      :key="group.name"
    >
      <div class="main-footer-nav__intro">
        <h6 class="main-footer-nav__title">{{ group.name }}</h6>
        <span class="material-icons main-footer-nav__icon">expand_more</span>
      </div>

      <router-link
        class="main-footer-nav__link"
        v-for="link in group.links"
        :key="link.title"
        :to="link.to"
      >
        {{ link.title }}
      </router-link>

    </div>

  </div>
</template>

<script>
import useNavigation from "src/hooks/common/useNavigation";

export default {
  name: "MainFooterNav",

  setup() {
    const {getGroups} = useNavigation();

    const groups = getGroups([
      'Payments',
      'Point of Sale',
      'Hardware',
      'Tools',
      'Developers',
      'Resources',
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
.main-footer-nav {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin-bottom: 50px;

  &__group {
    display: flex;
    flex-direction: column;
    width: 190px;
    padding: 15px 0;
  }

  &__intro {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
  }

  &__title {
    font-size: 14px;
    font-weight: 500;
    color: $grey400;
    margin-right: 5px;
  }

  &__icon {
    font-size: 16px;
    font-weight: 800;
    color: $grey400;
  }

  &__link {
    padding: 2px 0;
    cursor: pointer;
  }
}
</style>
