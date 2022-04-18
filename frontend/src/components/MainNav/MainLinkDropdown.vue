<template>
  <div class="link-dropdown" ref="elementRef">
    <q-route-tab
      class="link-dropdown__btn"
      :label="link.label ?? link.title"
      :to="{name: link.route}"
      no-caps
    />

    <transition
      appear
      enter-active-class="animated fadeIn"
      leave-active-class="animated fadeOut"
    >
      <div
        class="container link-dropdown__container"
        ref="dropdown"
        v-show="isFocused"
      >
        <div class="link-dropdown__content">
          <div
            v-if="link.children"
            class="link-dropdown__menu"
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

      </div>
    </transition>
  </div>
</template>

<script>
import {computed, toRef} from "vue";
import useNavigation from "src/hooks/common/useNavigation";
import useFocusObserver from "src/hooks/common/useFocusObserver";

export default {
  name: "MainLinkDropdown",

  props: {
    link: {
      type: Object,
      required: true,
    },
  },

  setup(props) {
    const {elementRef, isFocused} = useFocusObserver(300);

    const link = toRef(props, 'link');

    const {getGroups} = useNavigation();

    const groups = computed(() => link.value.groups ? getGroups(...link.value.groups) : []);

    return {
      groups,
      elementRef,
      isFocused,
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
    padding-top: 20px;
    padding-bottom: 20px;
    background-color: $white;
    width: 100vw;
    border-top: .5px solid $grey;
  }

  &__content {
    display: flex;
    justify-content: center;
  }

  &__menu {
    display: flex;
    flex-direction: column;
    padding: 10px 30px;
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
