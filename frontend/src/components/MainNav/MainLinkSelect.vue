<template>
  <div class="link-select" ref="elementRef">
    <main-link
      class="link-select__btn"
      :link="link"
    />

    <transition
      appear
      enter-active-class="animated fadeIn"
      leave-active-class="animated fadeOut"
    >
      <q-list
        class="link-select__container"
        v-show="isFocused"
      >
        <common-link
          class="link-select__link"
          v-for="(item, key) in link.select"
          :key="key"
          :link="item"
          @click="unsetFocus"
        />
      </q-list>

    </transition>
  </div>
</template>

<script>
import useFocusObserver from "src/hooks/common/useFocusObserver";
import MainLink from "components/MainNav/MainLink";
import CommonLink from "components/Common/CommonLink";

export default {
  name: "MainLinkSelect",

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

  setup() {
    const {elementRef, isFocused, unsetFocus} = useFocusObserver(300);

    return {
      elementRef,
      isFocused,
      unsetFocus,
    }
  }
}
</script>

<style lang="scss">
.link-select {
  &__container {
    position: fixed;
    display: flex;
    flex-direction: column;
    min-width: 200px;
    margin-left: -55px;
    padding: 25px 0;
    background-color: $white;
    border-top: .5px solid $grey;
  }

  &__link {
    padding: 12px 15px;
    color: $dark;
    font-weight: 400;
    font-size: 14px;
    text-transform: capitalize;

    &:hover {
      background-color: $grey-4;
    }
  }
}
</style>
