<template>
  <div class="link-dropdown">
    <div ref="dropdown">
      <q-btn
        class="link-dropdown__btn"
        no-caps
        flat
        @click="toggleDropdown"
      >
        {{ link.label ?? link.title }}
      </q-btn>
    </div>

    <transition
      appear
      enter-active-class="animated fadeIn"
      leave-active-class="animated fadeOut"
    >
      <div
        class="container link-dropdown__container"
        v-show="isDropdownOpen"
      >
        <div class="link-dropdown__content">
          <div
            v-if="link.children"
            class="link-dropdown__children"
          >
            <div class="link-dropdown__title">
              Menu
            </div>

            <router-link
              class="link-dropdown__link"
              v-for="child in link.children"
              :key="child.title"
              :to="{name: link.route}"
            >
              {{ child.label ?? child.title }}
            </router-link>
          </div>
        </div>

        <div class="link-dropdown__groups">
          <div
            class="link-dropdown__group"
            v-for="(item, key) in groups"
            :key="key"
          >
            <div class="link-dropdown__title">
              {{ item.group }}
            </div>

            <router-link
              class="link-dropdown__link"
              v-for="link in item.links"
              :key="link.title"
              :to="{name: link.route}"
            >
              {{ link.label ?? link.title }}
            </router-link>
          </div>
        </div>

      </div>
    </transition>
  </div>
</template>

<script>
import {computed, ref, toRef} from "vue";
import useNavigation from "src/hooks/common/useNavigation";

export default {
  name: "MainLinkDropdown",

  props: {
    link: {
      type: Object,
      required: true,
    },
  },

  setup(props) {
    const dropdown = ref(null);
    const isDropdownOpen = ref(false);

    const toggleDropdown = () => isDropdownOpen.value = !isDropdownOpen.value;

    const link = toRef(props, 'link');

    const {getGroups} = useNavigation();

    const groups = computed(() => {
      return link.value.groups
        ? getGroups(...link.value.groups)
        : [];
    });

    return {
      groups,
      dropdown,
      isDropdownOpen,
      toggleDropdown,
    }
  }
}
</script>

<style lang="scss">
.link-dropdown {

  &__btn {
    padding: 0 16px;
    min-height: 48px;
  }

  &__container {
    position: fixed;
    right: 0;
    display: flex;
    padding-top: 20px;
    padding-bottom: 20px;
    background-color: $white;
    width: 100vw;
    border-top: .5px solid $grey;
  }

  &__children {
    display: flex;
    flex-direction: column;
    padding: 10px 40px;
  }

  &__groups {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
    padding: 0 15px;
    border-left: 1px solid $grey-4;
  }

  &__group {
    padding: 10px 15px 25px;
    display: flex;
    flex-direction: column;
  }

  &__title {
    color: $dark;
    font-weight: 500;
    font-size: 15px;
    margin-bottom: 10px;
  }

  &__link {
    color: $grey-8;
    font-weight: 400;
    font-size: 13px;
    padding-bottom: 3px;
    text-transform: capitalize;

    &:hover {
      color: $dark
    }
  }
}
</style>
