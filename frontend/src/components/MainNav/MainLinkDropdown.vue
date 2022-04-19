<template>
  <div class="link-dropdown" ref="elementRef">
    <main-link
      class="link-dropdown__btn"
      :link="link"
    />

    <transition
      appear
      enter-active-class="animated fadeIn"
      leave-active-class="animated fadeOut"
    >
      <div
        class="container link-dropdown__container"
        v-show="isFocused"
      >
        <div class="link-dropdown__content">
          <div class="link-dropdown__groups">
            <div
              class="link-dropdown__group"
              v-for="(item, key) in groups"
              :key="key"
            >
              <div class="link-dropdown__title">
                {{ item.group }}
              </div>

              <common-link
                class="link-dropdown__link"
                v-for="link in item.links"
                :key="link.title"
                :link="link"
              />
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
import MainLink from "components/MainNav/MainLink";
import CommonLink from "components/Common/CommonLink";

export default {
  name: "MainLinkDropdown",

  components: {
    MainLink,
    CommonLink,
  },

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

  &__children {
    display: flex;
    flex-direction: column;
    padding: 10px 30px;
  }

  &__child {
    color: $grey-8;
    font-weight: 500;
    font-size: 15px;
    padding-bottom: 6px;
    text-transform: capitalize;

    &:hover {
      color: $dark
    }
  }

  &__groups {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
    padding: 0 15px;
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
